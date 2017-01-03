<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/31/15
 * Time: 10:37 PM
 */

namespace Viettut\Bundle\WebBundle\Controller;


use FOS\UserBundle\Model\UserInterface;
use Google_Client;
use Google_Service_Oauth2;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Viettut\Model\User\UserEntityInterface;

class AuthenController extends Controller
{
    /**
     * @Route("/facebook/login", name="facebook_login")
     */
    public function facebookLoginAction(Request $request)
    {
        $lecturerManager = $this->get('viettut_user.domain_manager.lecturer');
        $fb = new \Facebook\Facebook([
            'app_id' => '1245562308819573',
            'app_secret' => '55ea4598ddcd5707ef67aaa4d0224086',
            'default_graph_version' => 'v2.5',
        ]);

        $helper = $fb->getRedirectLoginHelper();
        try {
            $accessToken = $helper->getAccessToken();
            $fb->setDefaultAccessToken($accessToken);
            $response = $fb->get('/me?fields=id,name,email', $fb->getDefaultAccessToken());
            $userNode = $response->getGraphUser();
            $email = $userNode->getEmail();
            $avatar = sprintf('http://graph.facebook.com/%s/picture?type=normal', $userNode->getId());
            $user = $lecturerManager->findUserByUsernameOrEmail($email);

            if (!$user instanceof UserEntityInterface) {
                $user = $lecturerManager->createNew();

                $user
                    ->setEnabled(true)
                    ->setPlainPassword($userNode->getEmail())
                    ->setUsername($userNode->getEmail())
                    ->setEmail($userNode->getEmail())
                    ->setName($userNode->getName())
                    ->setFacebookId($userNode->getId())
                    ->setAvatar($avatar)
                ;
                $lecturerManager->save($user);
            } else {
                if (!$user->getGoogleId()) {
                    $user->setAvatar($avatar);
                }

                $user->setFacebookId($userNode->getId());
                $lecturerManager->save($user);
            }

            $token = new UsernamePasswordToken($user, $user->getPassword(), 'main', $user->getRoles());

            $this->get("security.token_storage")->setToken($token);
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
        }

        return $this->redirect($this->generateUrl('home_page'));
    }

    /**
     * @param Request $request
     * @Route("/google/login", name="google_login")
     */
    public function googleLoginAction(Request $request)
    {
        $code = $request->get('code');
        ########## Google Settings.Client ID, Client Secret from https://console.developers.google.com #############
        $client_id = '355171488116-rml9h7b9ivdn8ub5sgu6r6eh1vkluvav.apps.googleusercontent.com';
        $client_secret = 'eyeBjN6tVwQwNrkG-S0XQmxa';

        ###################################################################

        $client = new Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri('http://test.dev/app_dev.php/google/login');
        $client->addScope("email");
        $client->addScope("profile");

        $service = new Google_Service_Oauth2($client);

        $client->authenticate($code);
        $user = $service->userinfo->get();

        $userManager = $this->container->get('viettut_user.domain_manager.lecturer');
        $lecturer = $userManager->findUserByUsernameOrEmail($user['email']);
        if($lecturer instanceof UserEntityInterface) {
            $lecturer
                ->setGoogleId($user['id'])
                ->setName($user['name'])
                ->setGender($user['gender']);
            $userManager->save($lecturer);
        }
        else {
            $lecturer = $userManager->createNew();

            $lecturer->setEnabled(true)
                ->setPlainPassword($user['email'])
                ->setUsername($user['email'])
                ->setEmail($user['email'])
                ->setName($user['name'])
                ->setGoogleId($user['id'])
                ->setActive(true)
                ->setAvatar($user['picture'])
            ;

            $userManager->save($lecturer);
        }

        $token = new UsernamePasswordToken($lecturer, $lecturer->getPassword(), 'main', $lecturer->getRoles());

        $this->get("security.token_storage")->setToken($token);
        return $this->redirect($this->generateUrl('home_page'));
    }

    /**
     * @param Request $request
     * @Method({"POST"})
     * @Route("/github/login", name="github_login")
     */
    public function githubLoginAction(Request $request) {
        $client_id = '13f81c8b888c1b57cc86';
        $client_secret = 'e54d3f4bd0a0dff1631fe0a7e29d93d11712cb2e';
        $post = http_build_query(array(
            'client_id' => $client_id ,
            'redirect_uri' => $request->get('redirectUri') ,
            'client_secret' => $client_secret,
            'code' => $request->get('code')
        ));

        $context = stream_context_create(array("http" => array(
            "method" => "POST",
            "header" => "Content-Type: application/x-www-form-urlencodedrn" .
                "Content-Length: ". strlen($post) . "rn".
                "Accept: application/json" ,
            "content" => $post,
        )));
        $json_data = file_get_contents("https://github.com/login/oauth/access_token", false, $context);
        $r = json_decode($json_data , true);

        $access_token = $r['access_token'];

        $url = "https://api.github.com/user?access_token=$access_token";

        $data =  file_get_contents($url);

        //echo $data;
        $user_data  = json_decode($data , true);

        $username = $user_data['login'];
    }
}