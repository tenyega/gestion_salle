<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your full name.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Your full name should be at least {{ limit }} characters long.',
                        'max' => 255,
                    ]),
                ],
            ])
            ->add('address', TextareaType::class, [
                'constraints' => [
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'Your address should not exceed {{ limit }} characters.',
                    ]),
                ],
            ])
            // Ajoutez d'autres champs selon vos besoins
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
