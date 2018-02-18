<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

/**
 * Post entity
 *
 * @ApiResource()
 * @ApiFilter(OrderFilter::class, properties={"date"})
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
     * @Groups("read")
     */
    private $postId;

    /**
     * @var string post message
     *
     * @ORM\Column(type="string", length=250)
     * @Assert\NotBlank
     * @Groups("read")
     */
    private $message;

    /**
     * @var string post date
     *
     * @ORM\Column(name="date", type="datetime")
     * @Assert\NotBlank
     * @Groups("read")
     */
    private $date;

    /**
     * @var Users
     *
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="posts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id", nullable=false)
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
     * @return $this
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
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
}
