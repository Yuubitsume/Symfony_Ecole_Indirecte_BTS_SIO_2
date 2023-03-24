<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Matiere;
use App\Entity\NoteControle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('note')
            ->add('coefficient')
        
        ->add('user', EntityType::class, [
            // looks for choices from this entity
            'class' => User::class,
            'choice_label' => 'username',
         ])
        ->add('matiere', EntityType::class, [
            // looks for choices from this entity
            'class' => Matiere::class,
            'choice_label' => 'libelle',
        ]);     
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NoteControle::class,
        ]);
    }
}
