<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Mentions entity
 *
 * @ApiResource(iri="http://schema.org/Mentions", attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "force_eager"=false
 * })
 * @ORM\Entity
 */
class Mentions
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="mentions")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id", nullable=false)
     * @Groups("read")
     */
    private $user;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Posts")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="post_id", nullable=false)
     * @Groups("read")
     */
    private $post;

    /**
     * Get the user
     *
     * @return Users
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
