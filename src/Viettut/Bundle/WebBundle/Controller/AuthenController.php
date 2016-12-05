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

class AuthenController extends Controller
{
    /**
     * @Method({"POST"})
     * @Route("/facebook/login", name="facebook_login")
     */
    public function facebookLoginAction(Request $request)
    {
        $code = $request->get('code');
        $fb = new \Facebook\Facebook([
            'app_id' => '529276757135612',
            'app_secret' => '0fe34b757c10440e7259665a53dda55a',
            'default_graph_version' => 'v2.5',
            //'default_access_token' => '{access-token}', // optional
        ]);


        try {
            $accessToken = $fb->getOAuth2Client()->getAccessTokenFromCode($code, 'http://api.viettut.com/');
            $response = $fb->get('/me?fields=id,name,email', $accessToken->getValue());
            $user = $response->getGraphUser();
            $userManager = $this->container->get('viettut_user.domain_manager.lecturer');

            $lecturer = $userManager->findUserByUsernameOrEmail($user['email']);
            if($lecturer instanceof UserInterface) {
                $lecturer->setFacebookId($user['id'])
                ->setName($user['name']);
            }
            else {
                $userDiscriminator = $this->get('rollerworks_multi_user.user_discriminator');
                $userDiscriminator->setCurrentUser('viettut_user_system_lecturer');
                $lecturer = $userManager->createNew();

                $lecturer->setEnabled(true)
                    ->setFacebookId($user['id'])
                    ->setPlainPassword($user['email'])
                    ->setUsername($user['email'])
                    ->setEmail($user['email'])
                    ->setName($user['name'])
                    ->setActive(true)
                    ->setAvatar(sprintf('https://graph.facebook.com/%s/picture?type=square', $user['id']))
                ;
                $userManager->save($lecturer);
            }

            $jwtManager = $this->get('lexik_jwt_authentication.jwt_manager');
            $jwtTransformer = $this->get('viettut_api.service.jwt_response_transformer');
            $tokenString = $jwtManager->create($lecturer);

            return JsonResponse::create($jwtTransformer->transform(['token' => $tokenString], $lecturer), 200);
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            throw new UnauthorizedHttpException('Can not login with that account');
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            throw new UnauthorizedHttpException('Can not login with that account');
        }
    }

    /**
     * @param Request $request
     * @Method({"POST"})
     * @Route("/google/login", name="google_login")
     */
    public function googleLoginAction(Request $request)
    {
        $code = $request->get('code');
        ########## Google Settings.Client ID, Client Secret from https://console.developers.google.com #############
        $client_id = '355171488116-rml9h7b9ivdn8ub5sgu6r6eh1vkluvav.apps.googleusercontent.com';
        $client_secret = 'eyeBjN6tVwQwNrkG-S0XQmxa';
        $redirect_uri = $request->get('redirectUri');

        ###################################################################

        $client = new Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope("email");
        $client->addScope("profile");

        $service = new Google_Service_Oauth2($client);

        $client->authenticate($code);
        $user = $service->userinfo->get();

        $userManager = $this->container->get('viettut_user.domain_manager.lecturer');
        $lecturer = $userManager->findUserByUsernameOrEmail($user['email']);
        if($lecturer instanceof UserInterface) {
            $lecturer->setGoogleId($user['id'])
                ->setName($user['name'])
                ->setGender($user['gender']);
        }
        else {
            $userDiscriminator = $this->get('rollerworks_multi_user.user_discriminator');
            $userDiscriminator->setCurrentUser('viettut_user_system_lecturer');
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

        $jwtManager = $this->get('lexik_jwt_authentication.jwt_manager');
        $jwtTransformer = $this->get('viettut_api.service.jwt_response_transformer');
        $tokenString = $jwtManager->create($lecturer);

        return JsonResponse::create($jwtTransformer->transform(['token' => $tokenString], $lecturer), 200);
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