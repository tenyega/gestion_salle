<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;
    public const USER_REFERENCE = 'user-reference';



    // Constructor injection of UserPasswordHasherInterface
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->hasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail('user1@email.com')
            ->setPassword($this->hasher->hashPassword($user1, 'user1'))
            ->setRoles(['Role_User']);
        $this->addReference(self::USER_REFERENCE, $user1);

        $manager->persist($user1);


        $user2 = new User();
        $user2->setEmail('user2@email.com')
            ->setPassword($this->hasher->hashPassword($user2, 'user2'))
            ->setRoles(['Role_User']);
        $this->addReference(self::USER_REFERENCE, $user2);

        $manager->persist($user2);



        $user3 = new User();
        $user3->setEmail('user3@email.com')
            ->setPassword($this->hasher->hashPassword($user3, 'user2'))
            ->setRoles(['Role_User']);
        $this->addReference(self::USER_REFERENCE, $user3);

        $manager->persist($user3);

        $admin = new User();
        $admin->setEmail('admin@email.com')
            ->setPassword($this->hasher->hashPassword($admin, 'admin'))
            ->setRoles(['Role_Admin'])
        ;
        $manager->persist($admin);



        $manager->flush();
    }
}
