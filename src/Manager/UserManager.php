<?php

namespace App\Manager;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * The class UserManager manage the updating and finding of an user entity.
 */
class UserManager
{
    /**
     * @var EntityManager $entityManager
     */
    protected $entityManager;

    /**
     * @var UserPasswordEncoderInterface
     */
    protected $userPasswordEncoder;

    /**
     * UserManager constructor to inject services.
     *
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $userPasswordEncoder
    ){
        $this->entityManager = $entityManager;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * The function saves the
     *
     * @param User $user
     * @param bool $flush
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateUser(User $user, $flush = true)
    {
        if($user->getPlainPassword() != null) {
            $user->setPassword($this->userPasswordEncoder->encodePassword($user, $user->getPlainPassword()));
        }

        $this->entityManager->persist($user);

        if($flush) {
            $this->entityManager->flush();
        }
    }

    /**
     * @param $query
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     */
    public function findUserByUsernameOrEmail($query)
    {
        /**
         * @var $userRepository UserRepository
         */
        $userRepository = $this->entityManager->getRepository(User::class);
        return $userRepository->findByUsername($query);
    }
}