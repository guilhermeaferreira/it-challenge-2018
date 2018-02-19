<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Followers entity
 *
 * @ApiResource(iri="http://schema.org/Followers", attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "force_eager"=false
 * })
 * @ApiFilter(SearchFilter::class, properties={"userOriginal": "partial"})
 * @ORM\Entity
 * @UniqueEntity({"userOriginal", "userFollowed"})
 */
class Followers
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumn(name="original_user_id", referencedColumnName="user_id", nullable=false)
     * @Groups("read")
     */
    private $userOriginal;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="followers")
     * @ORM\JoinColumn(name="followed_user_id", referencedColumnName="user_id", nullable=false)
     * @Groups("read")
     */
    private $userFollowed;

    /**
     * Get the user (original)
     *
     * @return Users
     */
    public function getUserOriginal()
    {
        return $this->userOriginal;
    }

    /**
     * Get the user (followed)
     *
     * @return Users
     */
    public function getUserFollowed()
    {
        return $this->userFollowed;
    }

    /**
     * Set the user (original)
     *
     * @param Users $userOriginal
     * @return $this
     */
    public function setUserOriginal(Users $userOriginal)
    {
        $this->userOriginal = $userOriginal;

        return $this;
    }

    /**
     * Set the user (followed)
     *
     * @param Users $userFollowed
     * @return $this
     */
    public function setUserFollowed(Users $userFollowed)
    {
        $this->userFollowed = $userFollowed;

        return $this;
    }
}
