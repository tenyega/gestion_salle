<?php

namespace App\DataFixtures;

use App\Entity\Equipment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EquipmentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $equipment = new Equipment();
            $equipment->setName($faker->word);
            $equipment->setDescription($faker->sentence);
            $equipment->setType($faker->word);

            $manager->persist($equipment);
        }

        $manager->flush();
    }
}
