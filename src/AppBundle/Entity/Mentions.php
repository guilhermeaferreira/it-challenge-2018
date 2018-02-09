<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Mentions entity
 *
 * @ApiResource()
 * @ORM\Entity
 */
class Mentions
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id", nullable=false)
     */
    private $user;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Posts")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="post_id", nullable=false)
     */
    private $post;

    /**
     * Get the user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get the post
     *
     * @return Posts
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set the user
     *
     * @param Users $user
     * @return $this
     */
    public function setUser(Users $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Set the post
     *
     * @param Posts $post
     * @return $this
     */
    public function setPost(Posts $post)
    {
        $this->post = $post;

        return $this;
    }
}
