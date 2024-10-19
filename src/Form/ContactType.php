<?php

namespace App\Form;

use APP\DTO\contactDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Your Name',
                'empty_data' => ''
                // 'attr' => ['class' => 'form-control'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Your Email',
                'empty_data' => ''
            ])
            ->add('subject', TextType::class, [
                'label' => 'Subject',
                'empty_data' => ''
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                'empty_data' => ''
            ])
            ->add('send', SubmitType::class, [
                'label' => 'Send Message',
                'attr' => [
                    'class' => 'w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => contactDTO::class,
        ]);
    }
}
