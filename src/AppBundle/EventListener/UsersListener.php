<?php
namespace AppBundle\EventListener;

use AppBundle\Entity\Users;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersListener
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * UsersListener constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * Event before persist data
     *
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof Users) {
            return;
        }

        // encode the password
        $encoded = $this->passwordEncoder->encodePassword(
            $entity,
            $entity->getPassword()
        );
        $entity->setPassword($encoded);
    }
}