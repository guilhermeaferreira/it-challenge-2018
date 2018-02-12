<?php

namespace AppBundle\Action;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class Application extends Controller
{
    /**
     * @Route(
     *     name="app_main_page",
     *     path="/app",
     *     methods={"GET"}
     * )
     */
    public function loadTemplate()
    {
        return $this->render(
            '@App/base.html.twig',
            []
        );
    }
}