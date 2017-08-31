<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 2/26/17
 * Time: 9:29 PM
 */

namespace Viettut\Bundle\UserBundle\Handler;


use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class AuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{

    /**
     * @var string
     */
    protected $cookieDomain;

    /**
     * @var string
     */
    protected $cookiePath;

    /**
     * @var int
     */
    protected $cookieLifetime;

    /**
     * AuthenticationSuccessHandler constructor.
     * @param string $cookieDomain
     * @param string $cookiePath
     * @param int $cookieLifetime
     */
    public function __construct($cookieDomain, $cookiePath, $cookieLifetime)
    {
        $this->cookieDomain = $cookieDomain;
        $this->cookiePath = $cookiePath;
        $this->cookieLifetime = $cookieLifetime;
    }

    /**
     * This is called when an interactive authentication attempt succeeds. This
     * is called by authentication listeners inheriting from
     * AbstractAuthenticationListener.
     *
     * @param Request $request
     * @param TokenInterface $token
     *
     * @return Response never null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $session = $request->getSession();
        $session->set('is_logged_in', true);
        $session->set('logged_in_userid', $token->getUsername());
        $session->save();
        $request->setSession($session);

        $response = new RedirectResponse('/');
        $cookie = new Cookie('is_logged_in', true, time() + $this->cookieLifetime, $this->cookiePath, $this->cookieDomain);
        $response->headers->setCookie($cookie);

        $cookie = new Cookie('logged_in_userid', $token->getUsername(), time() + $this->cookieLifetime, $this->cookiePath, $this->cookieDomain);
        $response->headers->setCookie($cookie);

        return $response;
    }


    /**
     * @param InteractiveLoginEvent $event
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $token = $event->getAuthenticationToken();
        $request = $event->getRequest();
        $this->onAuthenticationSuccess($request, $token);
    }
}