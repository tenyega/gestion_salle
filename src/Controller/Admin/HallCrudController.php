<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use App\Entity\EventType;
use App\Entity\Hall;
use DateTime;
use Doctrine\DBAL\Types\DecimalType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DecimalField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]

class HallCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hall::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('area')
                ->setHelp('Enter Area of the hall')
                ->setLabel('m2'),
            TextField::new('accessibility'),
            IntegerField::new('capacityMax'),
            DateTimeField::new('openingTime'),
            MoneyField::new('pricePerHour') // Using MoneyField for decimal values
                ->setCurrency('EUR'), // Set the currency for the money field
            DateTimeField::new('closingTime'), // Changed from TextField to DateTimeField
            AssociationField::new('eventTypeId')
                ->setLabel('EventType') // Set a label for the field
                ->setFormTypeOption('choice_label', function (?EventType $eventType) {
                    return $eventType ? $eventType->getName() : 'No eventType'; // For forms
                }),
            AssociationField::new('addresseId')
                ->setLabel('City') // Set a label for the field
                ->setFormTypeOption('choice_label', function (?Address $address) {
                    return $address ? $address->getCity() : 'No City'; // For forms
                })
        ];
    }
}
