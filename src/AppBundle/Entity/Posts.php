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
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="post_id", type="integer", nullable=false)
     */
    private $postId;

    /**
     * @var string post message
     *
     * @ORM\Column(type="string", length=250)
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

    /**
     * @var Users
     *
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="posts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;

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
     * Returns the user for the post
     *
     * @return Users
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the post message
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set the user for the post
     *
     * @param Users $user
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
}
