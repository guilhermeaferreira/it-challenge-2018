<?php

namespace AppBundle\Action;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class Register extends Controller
{
    /**
     * @Route(
     *     name="app_register_page",
     *     path="/app/register",
     *     methods={"GET"}
     * )
     */
    public function __invoke()
    {
        return $this->render(
            '@App/register.html.twig', []
        );
    }
}