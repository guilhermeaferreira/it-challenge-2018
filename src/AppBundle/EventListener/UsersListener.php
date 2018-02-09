<?php
namespace AppBundle\EventListener;

use AppBundle\Entity\Mentions;
use AppBundle\Entity\Users;
use AppBundle\Entity\Posts;
use AppBundle\Service\GetMentions;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersListener
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var GetMentions
     */
    private $getMentions;

    /**
     * UsersListener constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GetMentions $getMentions
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder, GetMentions $getMentions)
    {
        $this->passwordEncoder  = $passwordEncoder;
        $this->getMentions      = $getMentions;
    }

    /**
     * Event before persist data
     *
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Users) {
            // encode the password
            $encoded = $this->passwordEncoder->encodePassword(
                $entity,
                $entity->getPassword()
            );
            $entity->setPassword($encoded);
        }

        if ($entity instanceof Posts) {
            // clear the message from HTML
            $entity->setMessage(
                strip_tags($entity->getMessage())
            );
        }
    }

    /**
     * Event after persist data
     *
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof Posts) {
            return;
        }

        $arrUsers = $this->getMentions
            ->setMessage($entity->getMessage())
            ->getUsers();

        if (empty($arrUsers)) {
            return;
        }

        $em = $args->getEntityManager();

        foreach ($arrUsers as $userName) {
            $user = $em->getRepository('AppBundle:Users')
                ->findOneBy([
                    'username' => $userName
                ]);

            if (empty($user)) {
                continue;
            }

            // save the mentions
            $mentions = new Mentions();
            $mentions->setPost($entity);
            $mentions->setUser($user);

            $em->persist($mentions);
            $em->flush();
        }
    }
}