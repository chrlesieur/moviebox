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
        $builder->add('title', TextType::class,[
                'label' => 'Titre du Film']);
        $builder->add('year', NumberType::class, ['label' => 'Année de sortie']);
        $builder->add('runtime', TextType::class, ['label' => 'Durée']);
        $builder->add('genre', TextType::class, ['label' => 'Genre']);
        $builder->add('director', TextType::class, ['label' => 'Réalisateur']);
        $builder->add('actors', TextType::class, ['label' => 'Acteurs principaux']);
        $builder->add('resume', TextareaType::class, ['label' => 'Synopsis']);
        $builder->add('country', TextType::class, ['label' => 'Pays']);
        $builder->add('poster', HiddenType::class, ['label' => 'Affiche du film']);
        $builder->add('imdbRating', TextType::class, ['label' => 'Note moyenne des internautes']);
        $builder->add('myCritic', TextareaType::class,
                ['label' =>'Votre critique du film',
                    'required' => false]);
        $builder->add('myRating', TextType::class,
                ['label' => 'Ma note',
                    'required' => false]);
        $builder->add('statut', ChoiceType::class,
                ['label' => 'Statut',
                    'choices' => ['A voir !' => true, 'Dejà vu' => false]]);
        $builder->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
