<?php

namespace App\Form;

use App\Entity\FilterSerie;
use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterSerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name of the Tv Show',
                'required' =>false,
            ])
            ->add('popularity', CheckboxType::class, [
                'label' => 'Most popular',
                'required' =>false,

            ])
            ->add('vote', CheckboxType::class, [
                'label' => 'Best Grading',
                'required' =>false,
            ])
            ->add('genres', EntityType::class, [
                'class' => Genre::class,
                'placeholder' => '',
                'label' => 'Genres',
                'required' =>false,

            ])
            ->add('lastAirDate', CheckboxType::class, [
                'label' => 'Last Air Date',
                'required' =>false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FilterSerie::class,
        ]);
    }
}
