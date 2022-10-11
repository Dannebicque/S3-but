<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\PostCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, ['label' => 'Titre du post', 'help' => 'Au moins 10 caractères'])
            ->add('datePublication', DateTimeType::class, ['label' => 'Date de publication', 'widget' => 'single_text'])
            ->add('message', TextareaType::class, ['label' => 'Message du post', 'attr' => ['rows' => 20]])
            ->add('category', EntityType::class, [
                'class' => PostCategory::class,//entité avec laquelle je fais la liaison
                'choice_label' => 'libelle', //champs ou la méthode (qui renvoie du texte) que j'affiche
                'label' => 'Catégorie du post'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
