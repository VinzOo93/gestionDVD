<?php

namespace App\Form;

use App\Entity\Serie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('overview')
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Cancelled' => 'Cancelled',
                    'returning' =>  'returning',
                    'ended' => 'ended',
                ],
            ])
            ->add('vote')
            ->add('popularity', NumberType::class,[
                'label' => 'popularity',
                'scale' => 2,

            ])
            ->add('genres')
            ->add('firstAirDate')
            ->add('lastAirDate')
            ->add('backdrop', FileType::class, [
                'label' => 'backdrop 1280*720',
                'mapped' => false,
                'required' => false,
            ])
            ->add('poster', FileType::class, [
                'label' => 'poster 350*520',
                'mapped' => false,
                'required' => false,
            ])
            ->add('tmdbId', NumberType::class,[
              'label' => 'tmdbId',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
