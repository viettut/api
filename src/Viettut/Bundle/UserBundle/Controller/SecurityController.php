<?php

namespace Viettut\Bundle\UserBundle\Controller;

use Google_Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;

class SecurityController extends BaseController
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function loginAction(Request $request)
    {
        $facebookRedirectUri = $this->getParameter('facebook_redirect_uri');
        $googleRedirectUri = $this->getParameter('google_redirect_uri');
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();

        $authErrorKey = Security::AUTHENTICATION_ERROR;
        $lastUsernameKey = Security::LAST_USERNAME;

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

        $csrfToken = $this->has('security.csrf.token_manager')
            ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
            : null;

        $fb = new \Facebook\Facebook([
            'app_id' => '1245562308819573',
            'app_secret' => '55ea4598ddcd5707ef67aaa4d0224086',
            'default_graph_version' => 'v2.5',
        ]);

        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email', 'user_likes']; // optional
        $facebookLoginUrl = $helper->getLoginUrl($facebookRedirectUri, $permissions);

        $api = new Google_Client();
        $api->setApplicationName("Viettut Academy"); // Set Application name
        $api->setClientId('355171488116-rml9h7b9ivdn8ub5sgu6r6eh1vkluvav.apps.googleusercontent.com'); // Set Client ID
        $api->setClientSecret('eyeBjN6tVwQwNrkG-S0XQmxa '); //Set client Secret
        $api->addScope('email');
        $api->addScope('profile');
        $api->setRedirectUri($googleRedirectUri); // Enter your file path (Redirect Uri) that you have set to get client ID in API console
        $googleLoginUrl = $api->createAuthUrl();

        return $this->renderLogin(array(
            'last_username' => $lastUsername,
            'error' => $error,
            'csrf_token' => $csrfToken,
            'facebookUrl' => $facebookLoginUrl,
            'googleUrl' => $googleLoginUrl
        ));
    }
}
