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
        $facebookAppId = $this->getParameter('facebook_app_id');
        $facebookAppSecret = $this->getParameter('facebook_app_secret');
        $facebookRedirectUri = $this->getParameter('facebook_redirect_uri');
        $googleClientId = $this->getParameter('google_client_id');
        $googleClientSecret = $this->getParameter('google_client_secret');
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
            'app_id' => $facebookAppId,
            'app_secret' => $facebookAppSecret,
            'default_graph_version' => 'v2.5',
        ]);

        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email', 'user_likes']; // optional
        $facebookLoginUrl = $helper->getLoginUrl($facebookRedirectUri, $permissions);

        $api = new Google_Client();
        $api->setApplicationName("Viettut Academy"); // Set Application name
        $api->setClientId($googleClientId); // Set Client ID
        $api->setClientSecret($googleClientSecret); //Set client Secret
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
