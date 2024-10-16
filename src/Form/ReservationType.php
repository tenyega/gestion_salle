<?php

namespace App\Form;

use App\Entity\Hall;
use App\Entity\Reservation;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startDate', null, [
                'widget' => 'single_text',
            ])
            ->add('endDate', null, [
                'widget' => 'single_text',
            ])
            ->add('startTime', null, [
                'widget' => 'single_text',
            ])
            ->add('endTime', null, [
                'widget' => 'single_text',
            ])
            ->add('isConfirmed')
            ->add('specialRequest')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('updatedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('userId', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('hallId', EntityType::class, [
                'class' => Hall::class,
                'choice_label' => 'id',
            ])
            // ->add('hall', EntityType::class, [
            //     'class' => Hall::class,
            //     'choice_label' => function (Hall $hall) {
            //         return sprintf(
            //             '%s (Area: ùs, Capacity: %d, Price per hour: $.2f)',
            //             $hall->getName(),
            //             $hall->getArea(),
            //             $hall->getCapacityMax(),
            //             $hall->getPricePerHour()

            //         );
            //     }
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
