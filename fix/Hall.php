<?php

namespace App\DataFixtures;

use App\Entity\Hall;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class HallFixtures extends Fixture
{
    public const HALL_REFERENCE = 'hall-reference';

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $hall = new Hall();
            $hall->setName($faker->company);
            $hall->setArea($faker->randomNumber(2));
            $hall->setAccessibility($faker->sentence);
            $hall->setCapacityMax($faker->numberBetween(50, 500));
            $hall->setPricePerHour($faker->randomFloat(2, 20, 200));
            $hall->setOpeningTime(\DateTime::createFromFormat('H:i:s', '05:30:00'));
            $hall->setClosingTime(\DateTime::createFromFormat('H:i:s', '23:30:00'));
            $hall->setEventTypeId($this->getReference(EventTypeFixtures::EVENT_TYPE_REFERENCE));
            $hall->setAddresseId($this->getReference(AddressFixtures::ADDRESS_REFERENCE));
            $this->addReference(self::HALL_REFERENCE, $hall);

            $manager->persist($hall);
        }

        $manager->flush();
    }
}
