<?php

namespace App\DataFixtures;

use App\Entity\Notification;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class NotificationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $notification = new Notification();
            $notification->setMessage($faker->sentence);
            $notification->isRead($faker->boolean);
            $notification->setUserId($this->getReference(UserFixtures::USER_REFERENCE));

            $manager->persist($notification);
        }

        $manager->flush();
    }
}
