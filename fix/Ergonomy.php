<?php

namespace App\DataFixtures;

use App\Entity\Ergonomy;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ErgonomyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $ergonomy = new Ergonomy();
            $ergonomy->setName($faker->word);
            $ergonomy->setDescription($faker->sentence);

            $manager->persist($ergonomy);
        }

        $manager->flush();
    }
}
