<?php

namespace App\Form;

use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', TextType::class, [
                'attr' => ['placeholder' => 'Pseudo'],
                'required' => true,
            ])
            ->add('mdp', PasswordType::class, [
                'attr' => ['placeholder' => 'Mot de passe'],
                'required' => true,
            ])
            ->add('nom', TextType::class, [
                'attr' => ['placeholder' => 'Nom'],
                'required' => true,
            ])
            ->add('prenom', TextType::class, [
                'attr' => ['placeholder' => 'Prénom'],
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'attr' => ['placeholder' => 'Email'],
                'required' => true,
            ])
            ->add('civilite', ChoiceType::class, [
                'choices' => [
                    'Homme' => false,
                    'Femme' => false,
                ],
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
