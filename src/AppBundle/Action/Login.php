<?php

namespace AppBundle\Action;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class Login extends Controller
{
    /**
     * @Route(
     *     name="app_login_page",
     *     path="/app/login",
     *     methods={"GET", "POST"}
     * )
     */
    public function _invoke(Request $request, AuthenticationUtils $authUtils)
    {
        if (true === $this->container->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('app_main_page');
        }

        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        return $this->render(
            '@App/login.html.twig', [
                'error' => $error
            ]
        );
    }
}