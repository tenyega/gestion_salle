<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Hall;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('hallId', EntityType::class, [
                'class' => Hall::class,
                'choice_label' => 'name', // Assurez-vous que la propriété 'name' existe dans l'entité Hall
                'label' => 'Hall',
            ])
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('endDate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('startTime', TimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('endTime', TimeType::class, [
                'widget' => 'single_text',
            ])
           ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}