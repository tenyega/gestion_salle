<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]

class ReservationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            
            DateTimeField::new('startDate'),
            DateTimeField::new('endDate'),
            TimeField::new('startTime'),
            TimeField::new('endTime'),
            BooleanField::new('isConfirmed')
                ->setLabel('Confirmed')
                ->setCustomOption('html', true),  // Enable raw HTML rendering
            TextareaField::new('specialRequest'),
            AssociationField::new('userId')
                ->setLabel('User') // Set a label for the field
                ->setFormTypeOption('choice_label', function (?User $user) {
                    return $user ? $user->getEmail() : 'No user'; // For forms
                })
                ->setCustomOption('choice_label', function (?User $user) {
                    return $user ? $user->getEmail() : 'No user'; // For display in lists
                }),
        ];
    }
}
