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
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Time;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a start date.',
                    ]),
                    new Date([
                        'message' => 'Please enter a valid start date.',
                    ]),
                ],
            ])
            ->add('endDate', DateType::class, [
                'widget' => 'single_text',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an end date.',
                    ]),
                    new Date([
                        'message' => 'Please enter a valid end date.',
                    ]),
                    new GreaterThan([
                        'propertyPath' => 'parent.all[startDate].data',
                        'message' => 'The end date must be after the start date.',
                    ]),
                ],
            ])
            ->add('startTime', TimeType::class, [
                'widget' => 'single_text',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a start time.',
                    ]),
                    new Time([
                        'message' => 'Please enter a valid start time.',
                    ]),
                ],
            ])
            ->add('endTime', TimeType::class, [
                'widget' => 'single_text',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an end time.',
                    ]),
                    new Time([
                        'message' => 'Please enter a valid end time.',
                    ]),
                    new GreaterThan([
                        'propertyPath' => 'parent.all[startTime].data',
                        'message' => 'The end time must be after the start time.',
                    ]),
                ],
            ]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
