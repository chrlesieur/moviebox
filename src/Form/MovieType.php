<?php

namespace App\Form;

use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('myCritic', TextareaType::class,
                ['label' =>'Votre critique du film',
                    'required' => false]);
        $builder->add('myRating', TextType::class,
                ['label' => 'Ma note',
                    'required' => false]);
        $builder->add('statut', ChoiceType::class,
                ['label' => 'Statut',
                    'placeholder' => 'Faites votre choix !',
                    'choices' => ['A voir !' => 'A voir !', 'Dejà vu' => 'Déja Vu']]);
        $builder->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
