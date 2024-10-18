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
                'label' => 'Search by City, Ergonomy, Equipment, or Event Type',
                'required' => false,
                'attr' => ['placeholder' => 'City, Ergonomy, Equipment, Event Type']
            ])
            // Deuxième input pour la capacité maximale
            ->add('capacity', IntegerType::class, [
                'label' => 'Capacity (Max)',
                'required' => false,
                'attr' => ['placeholder' => 'Max Capacity']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
