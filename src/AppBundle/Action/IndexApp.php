<?php

namespace AppBundle\Action;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class IndexApp extends Controller
{
    /**
     * @Route(
     *     name="app_main_page",
     *     path="/app",
     *     methods={"GET"}
     * )
     */
    public function __invoke()
    {
        // user iri used to add a new tweet post
        $userIri =
            str_replace('{id}.{_format}', '', $this->get('router')
                ->getRouteCollection()
                ->get('api_users_get_item')
                ->getPath()) // path with {id}.{format}
            . $this->container
                ->get('security.token_storage')
                ->getToken()
                ->getUser()
                ->getUserId(); // current user id logged

        // user nickname
        $userNickname = $this->container
            ->get('security.token_storage')
            ->getToken()
            ->getUser()
            ->getUsername();

        return $this->render(
            '@App/index.html.twig',
            [
                'userIri'     => $userIri,
                'userNickname' => $userNickname
            ]
        );
    }
}