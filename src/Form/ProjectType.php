<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class, [
                'label' => 'Titre du projet',
                'attr' => [
                    'placeholder' => "titre"
                ]
            ])
            ->add('introduction', TextType::class,[
                'label' => 'Introduction',
                'attr' => [
                    'placeholder' => "introduction"
                ]
            ])
            ->add('description', TextareaType::class,[
                'label' => 'Description',
                'attr' => [
                    'placeholder' => "description"
                ]
            ])
            ->add('image',UrlType::class,[
                'label' => 'Lien GutHub',
                'attr' => [
                    'placeholder' => "repository"
                ]
            ])
            ->add('url',UrlType::class,[
                'label' => 'URL',
                'attr' => [
                    'placeholder' => "télcharger"
                ]
            ])
            ->add('submit',SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => "btn btn-info"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
