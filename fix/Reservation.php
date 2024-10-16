<?php

namespace App\DataFixtures;

use App\Entity\Reservation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ReservationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

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
            $reservation->setUserId($this->getReference(UserFixtures::USER_REFERENCE));
            $reservation->setHallId($this->getReference(HallFixtures::HALL_REFERENCE));

            $manager->persist($reservation);
        }

        $manager->flush();
    }
}
