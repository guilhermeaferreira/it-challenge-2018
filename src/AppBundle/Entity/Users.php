<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * User entity
 *
 * @ApiResource(iri="http://schema.org/User", attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}
 * })
 * @ORM\Entity
 */
class Users implements UserInterface, \Serializable
{
    /**
     * @var int user id
     *
     * @Groups("read")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var string user nick name
     *
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=15, unique=true)
     * @Assert\NotBlank
     */
    private $username;

    /**
     * @var string user password
     *
     * @Groups("write")
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @Groups("read")
     * @ORM\OneToMany(targetEntity="Posts", mappedBy="user")
     */
    private $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * Returns the user id
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get posts by the user
     *
     * @return ArrayCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Set the user name (alias nickname)
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set the user password (it hashes by the event listener)
     *
     * @param $password
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    // user interface block

    /**
     * Get the user password
     * @see http://api.symfony.com/4.0/Symfony/Component/Security/Core/User/UserInterface.html
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the user role
     * @see http://api.symfony.com/4.0/Symfony/Component/Security/Core/User/UserInterface.html
     *
     * @return array
     */
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    /**
     * Get the user salt for the password
     * @see http://api.symfony.com/4.0/Symfony/Component/Security/Core/User/UserInterface.html
     *
     * @return null
     */
    public function getSalt()
    {
        return null; // no salt needed because bcrypt manages it internally
    }

    /**
     * Returns the user name (alias nickname)
     * @see http://api.symfony.com/4.0/Symfony/Component/Security/Core/User/UserInterface.html
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Erase password method for plaintext
     * @see http://api.symfony.com/4.0/Symfony/Component/Security/Core/User/UserInterface.html
     */
    public function eraseCredentials()
    {
    }

    // serialize block

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->userId,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /**
     * @param string $serialized
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->userId,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }
}
