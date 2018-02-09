<?php

namespace AppBundle\Service;

class GetMentions
{
    /**
     * @var string Message to be checked
     */
    private $message;

    /**
     * Return a list of users in the message
     *
     * @return array
     */
    public function getUsers()
    {
        preg_match_all("/(@\w+)/", $this->message, $matches);

        if (empty($matches[0])) {
            return [];
        }

        foreach ($matches[0] as &$user) {
            $user = substr($user, 1); // remove the @ from the beginning

        }

        return $matches[0];
    }

    /**
     * Set the message to be checked
     *
     * @param $message
     * @return $this|void
     */
    public function setMessage($message)
    {
        if (empty($message)) {
            return;
        }

        $this->message = $message;

        return $this;
    }
}
