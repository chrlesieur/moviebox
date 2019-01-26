<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 26/01/19
 * Time: 14:41
 */

namespace App\Form;

use App\Entity\MovieSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('movieSearchByTitle', SearchType::class,[
                'label' => 'Recherche par Titre de film']);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MovieSearch::class,
        ]);
    }
}