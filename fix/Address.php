<?php

namespace App\DataFixtures;

use App\Entity\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AddressFixtures extends Fixture
{

    public const ADDRESS_REFERENCE = 'address-reference';

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $address = new Address();
            $address->setNumber($faker->buildingNumber);
            $address->setStreet($faker->streetName);
            $address->setCountry($faker->country);
            $address->setCity($faker->city);
            $address->setCodePostal($faker->postcode);
            $this->addReference(self::ADDRESS_REFERENCE, $address);

            $manager->persist($address);
        }

        $manager->flush();
    }
}
