<?php

namespace App\DataFixtures;

use App\Entity\EventType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EventTypeFixtures extends Fixture
{
    public const EVENT_TYPE_REFERENCE = 'event-type-reference';
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $eventType = new EventType();
            $eventType->setName($faker->word);
            $eventType->setDescription($faker->sentence);
            $this->addReference(self::EVENT_TYPE_REFERENCE, $eventType);
            $manager->persist($eventType);
        }

        $manager->flush();
    }
}
