<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Post entity
 *
 * @ApiResource()
 * @ORM\Entity
 */
class Posts
{
    /**
     * @var int post id
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $postId;

    /**
     * @var string post message
     *
     * @ORM\Column(type="string", length=250, unique=true)
     * @Assert\NotBlank
     */
    private $message;

    /**
     * @var string post date
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     */
    private $date;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * Returns the post id
     *
     * @return int
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Returns the post message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Returns the post date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the post message
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
}
