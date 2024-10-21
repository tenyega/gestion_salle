<?php
// src/Form/SearchFormType.php

namespace App\Form;

use App\Entity\City;
use App\Entity\Ergonomy;
use App\Entity\Equipment;
use App\Entity\EventType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // Premier input pour les filtres multiples
            ->add('filter', TextType::class, [
                'label' => 'Search by : ',
                'label_attr' => [
                    'class' => 'block text-sm font-medium text-gray-700 '
                ],
                'required' => false,
                'attr' => ['placeholder' => 'Country, City, Ergonomy, Equipment, ...']
            ])
            // Deuxième input pour la capacité ou nombre de personne
            ->add('capacity', IntegerType::class, [
                'label' => 'Capacity ',
                'label_attr' => [
                    'class' => 'block text-sm font-medium text-gray-700'
                ],
                'required' => false,
            //    'attr' => ['placeholder' => 'Max Capacity']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
