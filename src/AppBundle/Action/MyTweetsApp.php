<?php

namespace AppBundle\Action;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MyTweetsApp extends Controller
{
    /**
     * @Route(
     *     name="app_my_tweets_page",
     *     path="/app/my-tweets",
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

        // get the current user logged id
        $userId = $this->container
                ->get('security.token_storage')
                ->getToken()
                ->getUser()
                ->getUserId();

        // user nickname
        $userNickname = $this->container
            ->get('security.token_storage')
            ->getToken()
            ->getUser()
            ->getUsername();

        return $this->render(
            '@App/my-tweets.html.twig',
            [
                'userId'       => $userId,
                'userNickname' => $userNickname,
                'userIri'     => $userIri
            ]
        );
    }
}