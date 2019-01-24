<?php

namespace App\Form;

use App\Entity\Movie;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('field_name', SearchType::class, [
                'label' => 'Recherche par Titre'])
            ->add('title', TextType::class,[
                'label' => 'Titre du Film'])
            ->add('year', NumberType::class, ['label' => 'Année de sortie'])
            ->add('runtime', TextType::class, ['label' => 'Durée'])
            ->add('genre', TextType::class, ['label' => 'Genre'])
            ->add('director', TextType::class, ['label' => 'Réalisateur'])
            ->add('actors', TextType::class, ['label' => 'Acteurs principaux'])
            ->add('resume', TextareaType::class, ['label' => 'Synopsis'])
            ->add('country', TextType::class, ['label' => 'Pays'])
            ->add('poster', HiddenType::class, ['label' => 'Affiche du film'])
            ->add('imdbRating', TextType::class, ['label' => 'Note moyenne des internautes'])
            ->add('myCritic', TextareaType::class, ['label' =>'Votre critique du film'])
            ->add('myRating', TextType::class, ['label' => 'Ma note'])
            ->add('statut', ChoiceType::class,
                ['label' => 'statut',
                    'choices' => ['A voir !' => true, 'Dejà vu' => false]])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
