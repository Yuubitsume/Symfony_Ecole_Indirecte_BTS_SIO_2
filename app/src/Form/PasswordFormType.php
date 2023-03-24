<?php

namespace App\Form;


use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class PasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('plainPassword', RepeatedType::class, [
            // instead of being set onto the object directly,
            // this is read and encoded in the controller
            'mapped' => false,
            'options' => ['attr' => ['class' => 'password-field']],
            'attr' => ['autocomplete' => 'new-password'],
            'type' => PasswordType::class,
            'required' => true,
            'first_options'  => array(
                'label' => 'Password',
                'attr' => array('placeholder' => 'Enter password')
            ),
            'second_options' => array(
                'label' => 'Repeat Password',
                'attr' => array('placeholder' => 'Retype password')
            ),
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a password',
                ]),
                
                new Length([
                    'min' => 8,
                    'minMessage' => 'Your password should be at least 8 characters',
                    // max length allowed by Symfony for security reasons
                    'max' => 40,
                ]),
                new Regex([
                    'pattern' => '/[\d]/',
                    'match' => true,
                    'message' => 'You need minimum 1 number',
                ]),
                new Regex([
                    'pattern' => '/[!?#%]/',
                    'match' => true,
                    'message' => 'You need minimum 1 Special Caracter !,?,#',
                ]),
                new Regex([
                    'pattern' => '/[a-z]/',
                    'match' => true,
                    'message' => 'You need minimum 1 min letter',
                ]),
                new Regex([
                    'pattern' => '/[A-Z]/',
                    'match' => true,
                    'message' => 'You need minimum 1 Maj',
                ]),
                
            ],
        ]);
    }
}

   