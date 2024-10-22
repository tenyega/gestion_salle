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
use Symfony\Component\Mime\Message;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Time;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

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
                    new GreaterThanOrEqual([
                        'value' => new \DateTime(),  // Ensures the date is greater than or equal to today's date
                        'message' => 'The date must be today or later.',
                    ])

                ],
            ])
            ->add('endDate', DateType::class, [
                'widget' => 'single_text',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an end date.',
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
                ],
            ])
            ->add('endTime', TimeType::class, [
                'widget' => 'single_text',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an end time.',
                    ]),
                ],
            ]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,  // Assuming your form is for the Reservation entity
            'constraints' => [
                new Callback([$this, 'validateDates']),
            ],
        ]);
    }
    public function validateDates($reservation, ExecutionContextInterface $context)
    {
        $startDate = $reservation->getStartDate();
        $endDate = $reservation->getEndDate();

        if ($endDate < $startDate) {
            $context->buildViolation('The end date must be greater than or equal to the start date.')
                ->atPath('endDate')
                ->addViolation();
        }
    }
}
