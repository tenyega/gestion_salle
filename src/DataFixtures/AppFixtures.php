<?php

namespace App\DataFixtures;


namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Equipment;
use App\Entity\Ergonomy;
use App\Entity\EventType;
use App\Entity\Hall;
use App\Entity\Notification;
use App\Entity\Reservation;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;
    // Constructor injection of UserPasswordHasherInterface
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->hasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $eventArray = [];
        $addressArray = [];
        $userArray = [];
        $hallArray = [];


        //USER
        $user1 = new User();
        $user1->setEmail('user1@email.com')
            ->setPassword($this->hasher->hashPassword($user1, 'user1'))
            ->setRoles(['Role_User']);
        $userArray[] = $user1;
        $manager->persist($user1);


        $user2 = new User();
        $user2->setEmail('user2@email.com')
            ->setPassword($this->hasher->hashPassword($user2, 'user2'))
            ->setRoles(['Role_User']);
        $userArray[] = $user2;

        $manager->persist($user2);



        $user3 = new User();
        $user3->setEmail('user3@email.com')
            ->setPassword($this->hasher->hashPassword($user3, 'user2'))
            ->setRoles(['Role_User']);
        $userArray[] = $user3;

        $manager->persist($user3);

        $admin = new User();
        $admin->setEmail('admin@email.com')
            ->setPassword($this->hasher->hashPassword($admin, 'admin'))
            ->setRoles(['Role_Admin'])
        ;
        $manager->persist($admin);
        $manager->flush();




        //ADDRESS
        for ($i = 0; $i < 10; $i++) {
            $address = new Address();
            $address->setNumber($faker->buildingNumber);
            $address->setStreet($faker->streetName);
            $address->setCountry($faker->country);
            $address->setCity($faker->city);
            $address->setCodePostal($faker->postcode);
            $addressArray[] = $address;
            $manager->persist($address);
        }
        $manager->flush();

        //Equipment
        for ($i = 0; $i < 10; $i++) {
            $equipment = new Equipment();
            $equipment->setName($faker->unique()->word);
            $equipment->setDescription($faker->sentence);
            $equipment->setType($faker->unique()->word);

            $manager->persist($equipment);
        }
        $manager->flush();
        //Ergonomy
        for ($i = 0; $i < 10; $i++) {
            $ergonomy = new Ergonomy();
            $ergonomy->setName($faker->unique()->word);
            $ergonomy->setDescription($faker->sentence);
            $manager->persist($ergonomy);
        }
        $manager->flush();

        //EVENT TYPE
        for ($i = 0; $i < 10; $i++) {
            $eventType = new EventType();
            $eventType->setName($faker->unique()->word);
            $eventType->setDescription($faker->sentence);
            $eventArray[] = $eventType;
            $manager->persist($eventType);
        }
        $manager->flush();
        // HALL
            $hall = new Hall();
            $hall->setName($faker->unique()->company);
            $hall->setArea($faker->randomNumber(2));
            $hall->setAccessibility($faker->sentence);
            $hall->setCapacityMax($faker->numberBetween(50, 500));
            $hall->setPricePerHour($faker->randomFloat(2, 20, 200));
            $hall->setOpeningTime(\DateTime::createFromFormat('H:i:s', '05:30:00'));
            $hall->setClosingTime(\DateTime::createFromFormat('H:i:s', '23:30:00'));
            $hall->setEventTypeId($faker->randomElement($eventArray));  
            $hall->setAddresseId($faker->randomElement($addressArray));  
            $hallArray[] = $hall;
            $manager->persist($hall);

            $hall2 = new Hall();
            $hall2->setName($faker->unique()->company);
            $hall2->setArea($faker->randomNumber(2));
            $hall2->setAccessibility($faker->sentence);
            $hall2->setCapacityMax($faker->numberBetween(50, 500));
            $hall2->setPricePerHour($faker->randomFloat(2, 20, 200));
            $hall2->setOpeningTime(\DateTime::createFromFormat('H:i:s', '05:30:00'));
            $hall2->setClosingTime(\DateTime::createFromFormat('H:i:s', '23:30:00'));
            $hall2->setEventTypeId($faker->randomElement($eventArray));  
            $hall2->setAddresseId($faker->randomElement($addressArray));  
            $hallArray[] = $hall2;
            $manager->persist($hall2);

            $hall3 = new Hall();
            $hall3->setName($faker->unique()->company);
            $hall3->setArea($faker->randomNumber(2));
            $hall3->setAccessibility($faker->sentence);
            $hall3->setCapacityMax($faker->numberBetween(50, 500));
            $hall3->setPricePerHour($faker->randomFloat(2, 20, 200));
            $hall3->setOpeningTime(\DateTime::createFromFormat('H:i:s', '05:30:00'));
            $hall3->setClosingTime(\DateTime::createFromFormat('H:i:s', '23:30:00'));
            $hall3->setEventTypeId($faker->randomElement($eventArray));  
            $hall3->setAddresseId($faker->randomElement($addressArray));  
            $hallArray[] = $hall3;
            $manager->persist($hall3);


        $manager->flush();

        //NOTIFICATION
        for ($i = 0; $i < 10; $i++) {
            $notification = new Notification();
            $notification->setMessage($faker->sentence);
            $notification->isRead($faker->boolean(80));
            $notification->setUserId($faker->randomElement($userArray));

            $manager->persist($notification);
        }

        $manager->flush();
        //RESERVATION
        for ($i = 0; $i < 10; $i++) {
            $reservation = new Reservation();

            $startTime = \DateTime::createFromFormat('H:i:s', $faker->time());
            $endTime = clone $startTime;
            $endTime->modify('+' . $faker->numberBetween(30, 300) . ' minutes');


            $reservation->setStartDate($faker->dateTimeBetween('-1 day', 'now'));
            $reservation->setEndDate($faker->dateTimeBetween($reservation->getStartDate(), '+1 day'));
            $reservation->setStartTime($startTime);
            $reservation->setEndTime($endTime);
            $reservation->isConfirmed($faker->boolean);
            $reservation->setSpecialRequest($faker->sentence);
            $reservation->setUserId($faker->randomElement($userArray));
            $reservation->setHallId($faker->randomElement($hallArray));

            $manager->persist($reservation);
        }

        $manager->flush();
    }
}
