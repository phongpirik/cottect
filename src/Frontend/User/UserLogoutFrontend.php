<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/5/18
 * Time: 11:46 AM
 */

namespace Cottect\Frontend\User;

use Cottect\Form\Frontend\User\UserLogoutFrontendForm;
use Cottect\Frontend\AuthenticationFrontend;
use Cottect\Utils\Session;
use Symfony\Component\HttpFoundation\Request;
use Cottect\Utils\RouteName;
use Cottect\Utils\RoutePath;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class UserLogoutFrontend extends AuthenticationFrontend
{
    /**
     * @Route(RoutePath::FRONTEND_USER_LOGOUT, name=RouteName::FRONTEND_USER_LOGOUT)
     * @Method({"POST"})
     * @param Request $request
     * @param Session $session
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Exception
     */
    public function logout(Request $request, Session $session)
    {
        $form = $this->createForm(UserLogoutFrontendForm::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $session->clear();

            return $this->redirectToRoute(RouteName::FRONTEND_USER_LOGIN);
        }

        throw new \Exception('This should never be reached!');
    }
}
