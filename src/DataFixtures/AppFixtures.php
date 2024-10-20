<?php

namespace App\DataFixtures;


namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Equipment;
use App\Entity\Ergonomy;
use App\Entity\EventType;
use App\Entity\Hall;
use App\Entity\HallEquipment;
use App\Entity\HallErgonomy;
use App\Entity\HallImage;
use App\Entity\Images;
use App\Entity\Notification;
use App\Entity\Reservation;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints\Length;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

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
        $equipmentArray = [];
        $ergonomyArray = [];
        $imgArray = [];


        # Liste des équipements
        $equipments = [
            [
                "name" => "Video Projector",
                "description" => "A device that projects images or videos onto a screen or wall.",
                "type" => "Hardware"
            ],
            [
                "name" => "Interactive Screen",
                "description" => "A touchscreen display that allows direct interaction with the projected content.",
                "type" => "Hardware"
            ],
            [
                "name" => "Computer (Desktop/Laptop)",
                "description" => "A computing device used for various tasks such as browsing, presentations, and more.",
                "type" => "Hardware"
            ],
            [
                "name" => "Video Conference System",
                "description" => "A set of devices enabling real-time video communication over distances.",
                "type" => "Hardware"
            ],
            [
                "name" => "Digital Whiteboard",
                "description" => "An interactive surface used for writing or drawing electronically during presentations.",
                "type" => "Hardware"
            ],
            [
                "name" => "Audio System",
                "description" => "Equipment used to amplify and deliver clear sound in the room.",
                "type" => "Hardware"
            ],
            [
                "name" => "Wireless Microphone",
                "description" => "Devices that capture voice or sound without the need for cables.",
                "type" => "Hardware"
            ],
            [
                "name" => "HDMI and USB Cables",
                "description" => "Connectors and cables used to link devices like computers and projectors.",
                "type" => "Hardware"
            ],
            [
                "name" => "Printer/Scanner",
                "description" => "A multifunctional device used to print and scan documents.",
                "type" => "Hardware"
            ],
            [
                "name" => "High-Speed Wi-Fi",
                "description" => "Wireless high-speed internet connection for all devices in the room.",
                "type" => "Software"
            ],
            [
                "name" => "Extra Power Outlets",
                "description" => "Multiple electrical outlets for powering various devices.",
                "type" => "Hardware"
            ],
            [
                "name" => "Mobile Charging Station",
                "description" => "Stations or panels allowing mobile devices to be charged.",
                "type" => "Hardware"
            ],
            [
                "name" => "Adjustable Air Conditioning",
                "description" => "Systems allowing control of room temperature for optimal comfort.",
                "type" => "Hardware"
            ],
            [
                "name" => "Ergonomic Chairs",
                "description" => "Chairs designed for prolonged comfort, adjustable for height and back support.",
                "type" => "Hardware"
            ],
            [
                "name" => "Touch Control Tablets",
                "description" => "Devices for managing room equipment via a touch interface.",
                "type" => "Hardware"
            ],
            [
                "name" => "Security Cameras",
                "description" => "Surveillance devices ensuring safety within the space.",
                "type" => "Hardware"
            ],
            [
                "name" => "Blackout Curtains",
                "description" => "Blinds or curtains that block or reduce natural light in the room.",
                "type" => "Hardware"
            ],
            [
                "name" => "Water/Coffee Dispensers",
                "description" => "Machines providing water, coffee, or other beverages.",
                "type" => "Hardware"
            ],
            [
                "name" => "Translation Headphones",
                "description" => "Headsets allowing attendees to hear real-time translation during conferences.",
                "type" => "Hardware"
            ],
            [
                "name" => "Blu-ray/DVD Player",
                "description" => "Device for playing movies or presentations from Blu-ray or DVD discs.",
                "type" => "Hardware"
            ]
        ];


        # Liste des critères ergonomiques
        $ergonomics = [
            [
                "name" => "Natural Lighting",
                "description" => "Presence of natural light in the room, promoting a comfortable and productive work environment."
            ],
            [
                "name" => "Accessible for PRM",
                "description" => "Rooms and facilities accessible to people with reduced mobility, including ramps, elevators, and widened doors."
            ],
            [
                "name" => "Height-Adjustable Tables",
                "description" => "Tables that can be adjusted in height to provide ergonomics suited to different users."
            ],
            [
                "name" => "Lumbar Support Chairs",
                "description" => "Chairs designed to offer lower back support, improving comfort during long sessions."
            ],
            [
                "name" => "Sound Insulation",
                "description" => "Sound insulation to limit external noise, ensuring a quiet working environment."
            ],
            [
                "name" => "Adjustable Temperature",
                "description" => "Systems allowing temperature adjustments for optimal comfort of the occupants."
            ],
            [
                "name" => "Spacious Layout",
                "description" => "Room layout with enough space for users to move and sit comfortably."
            ],
            [
                "name" => "Easy Restroom Access",
                "description" => "Proximity to restrooms, allowing easy access without disrupting activities."
            ],
            [
                "name" => "Adjustable LED Lighting",
                "description" => "LED lighting that can be adjusted for brightness, catering to different conditions and preferences."
            ],
            [
                "name" => "Non-Slip Flooring",
                "description" => "Flooring designed to prevent slips, ensuring user safety."
            ],
            [
                "name" => "Natural Ventilation",
                "description" => "Rooms with good ventilation or natural airflow to ensure optimal air quality."
            ],
            [
                "name" => "Emergency Exit Signs",
                "description" => "Visible signs and directions to quickly locate emergency exits in case of an emergency."
            ],
            [
                "name" => "Accessible Power Outlets",
                "description" => "Power outlets easily accessible at each workstation, avoiding the need for extension cords."
            ],
            [
                "name" => "Laptop Support Stands",
                "description" => "Dedicated stands to position laptops at an ergonomic height for better posture."
            ],
            [
                "name" => "Accessible Control Systems",
                "description" => "Controls for lighting and climate within easy reach, allowing quick adjustments without disruption."
            ],
            [
                "name" => "Long-Term Seating Comfort",
                "description" => "Furniture designed to offer maximum comfort during extended periods, including ergonomic chairs."
            ],
            [
                "name" => "Flexible Furniture Layout",
                "description" => "Furniture that can easily be reconfigured to suit the needs of the activity."
            ],
            [
                "name" => "Comfortable Floor Covering",
                "description" => "Soft floor coverings like carpets or rugs to improve comfort and reduce foot noise."
            ],
            [
                "name" => "Nearby Relaxation Areas",
                "description" => "Relaxation or break areas located nearby for users to rest during breaks."
            ],
            [
                "name" => "Rounded Edge Tables",
                "description" => "Tables designed with rounded edges to minimize the risk of injury from accidental contact."
            ]
        ];


        //USER
        $user1 = new User();
        $user1->setEmail('user1@email.com')
            ->setPassword($this->hasher->hashPassword($user1, 'user1'))
            ->setRoles(['ROLE_USER'])
            ->setFullName($faker->firstName() . ' ' . $faker->lastName())
            ->isVerified(true);

        $userArray[] = $user1;
        $manager->persist($user1);


        $user2 = new User();
        $user2->setEmail('user2@email.com')
            ->setPassword($this->hasher->hashPassword($user2, 'user2'))
            ->setRoles(['ROLE_USER'])
            ->setFullName($faker->firstName() . ' ' . $faker->lastName())
            ->isVerified(false);

        $userArray[] = $user2;

        $manager->persist($user2);



        $user3 = new User();
        $user3->setEmail('user3@email.com')
            ->setPassword($this->hasher->hashPassword($user3, 'user2'))
            ->setFullName($faker->firstName() . ' ' . $faker->lastName())
            ->setRoles(['ROLE_USER'])
            ->isVerified(true);

        $userArray[] = $user3;

        $manager->persist($user3);

        $admin = new User();
        $admin->setEmail('admin@email.com')
            ->setPassword($this->hasher->hashPassword($admin, 'admin'))
            ->setRoles(['ROLE_ADMIN'])
            ->setFullName($faker->firstName() . ' ' . $faker->lastName())
            ->isVerified(true)
        ;
        $manager->persist($admin);
        $manager->flush();




        //ADDRESS
        for ($i = 0; $i < 15; $i++) {
            $address = new Address();
            $address->setNumber($faker->buildingNumber);
            $address->setStreet($faker->streetName);
            $address->setCountry($faker->country);
            $address->setCity($faker->city);
            $address->setCodePostal($faker->postcode);
            $addressArray[$i] = $address;

            $manager->persist($address);
        }
        $manager->flush();

        //Equipment
        for ($i = 0; $i < count($equipments); $i++) {
            $equipment = new Equipment();
            $equipment->setName($equipments[$i]['name']);
            $equipment->setDescription($equipments[$i]['description']);
            $equipment->setType($equipments[$i]['type']);
            $equipmentArray[] = $equipment;
            $manager->persist($equipment);
        }
        $manager->flush();
        //Ergonomy
        for ($i = 0; $i < count($ergonomics); $i++) {
            $ergonomy = new Ergonomy();
            $ergonomy->setName($ergonomics[$i]['name']);
            $ergonomy->setDescription($ergonomics[$i]['description']);
            $ergonomyArray[] = $ergonomy;
            $manager->persist($ergonomy);
        }
        $manager->flush();

        //EVENT TYPE
        for ($i = 0; $i < 15; $i++) {
            $eventType = new EventType();
            $eventType->setName($faker->unique()->word);
            $eventType->setDescription($faker->sentence);

            $eventArray[$i] = $eventType;
            $manager->persist($eventType);
        }
        $manager->flush();

        //IMAGES

        for ($i = 0; $i < 46; $i++) {
            $images = new Images();
            $images->setTitle($faker->title())
                ->setImg('img-' . $i . '.jpg');
            $imgArray[$i] = $images;
            $manager->persist($images);
        }
        $manager->flush();

        // HALL
        for ($i = 0; $i < 15; $i++) {
            $hall = new Hall();
            $hall->setName($faker->company);
            $hall->setArea($faker->randomNumber(2));
            $hall->setAccessibility($faker->sentence);
            $hall->setCapacityMax($faker->numberBetween(50, 500));
            $hall->setPricePerHour($faker->randomFloat(2, 20, 200));
            $hall->setOpeningTime(\DateTime::createFromFormat('H:i:s', '05:30:00'));
            $hall->setClosingTime(\DateTime::createFromFormat('H:i:s', '23:30:00'));
            $hall->setEventTypeId($eventArray[$i]);
            $hall->setAddresseId($addressArray[$i]);
            $hall->setMainImg($faker->randomElement($imgArray));

            $hallArray[] = $hall;
            $manager->persist($hall);
        }

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
        for ($i = 0; $i < 15; $i++) {
            $reservation = new Reservation();

            $startTime = \DateTime::createFromFormat('H:i:s', $faker->time());
            $endTime = clone $startTime;
            $endTime->modify('+' . $faker->numberBetween(30, 300) . ' minutes');
            $startDate = $faker->dateTimeBetween('now', '+5 months');
            $endDate = $faker->dateTimeBetween($startDate, (clone $startDate)->add(new \DateInterval('P1D')));

            $reservation->setStartDate($startDate);
            $reservation->setEndDate($endDate);

            $reservation->setStartTime($startTime);
            $reservation->setEndTime($endTime);
            $reservation->isConfirmed($faker->boolean);
            $reservation->setSpecialRequest($faker->sentence);
            $reservation->setUserId($faker->randomElement($userArray));
            $reservation->setHallId($faker->randomElement($hallArray));

            $manager->persist($reservation);
        }


        // FEW RESERVATIONS WITH dates near 
        for ($i = 0; $i < 6; $i++) {
            $reservation = new Reservation();

            $startTime = \DateTime::createFromFormat('H:i:s', $faker->time());
            $endTime = clone $startTime;
            $endTime->modify('+' . $faker->numberBetween(30, 300) . ' minutes');
            $startDate = $faker->dateTimeBetween('now', '+5 days');
            $endDate = $faker->dateTimeBetween($startDate, (clone $startDate)->add(new \DateInterval('P1D')));

            $reservation->setStartDate($startDate);
            $reservation->setEndDate($endDate);
            $reservation->setStartTime($startTime);
            $reservation->setEndTime($endTime);
            $reservation->isConfirmed($faker->boolean);
            $reservation->setSpecialRequest($faker->sentence);
            $reservation->setUserId($faker->randomElement($userArray));
            $reservation->setHallId($faker->randomElement($hallArray));

            $manager->persist($reservation);
        }

        $manager->flush();

        //INTERMIDIATE hall_equipment

        for ($i = 0; $i < 100; $i++) {
            $hallEquipment = new HallEquipment();
            $hallEquipment->setHallId($faker->randomElement($hallArray))
                ->setEquipmentId($faker->randomElement($equipmentArray));
            $manager->persist($hallEquipment);
        }
        $manager->flush();



        //INTERMIDIATE hall_ergonomy
        for ($i = 0; $i < 100; $i++) {

            $hallErgonomy = new HallErgonomy();
            $hallErgonomy->setHallId($faker->randomElement($hallArray))
                ->setErgonomyId($faker->randomElement($ergonomyArray));
            $manager->persist($hallErgonomy);
        }
        $manager->flush();


        //INTERMIDIATE hall_image
        for ($i = 0; $i < 50; $i++) {
            $hallImage = new HallImage();
            $hallImage->setHallId($faker->randomElement($hallArray))
                ->setImgId($faker->randomElement($imgArray));
            $manager->persist($hallImage);
        }
        $manager->flush();
    }
}
