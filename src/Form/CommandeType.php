<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\Membre;
use App\Entity\Vehicule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('membre', EntityType::class, [
                'class' => Membre::class,
                'choice_label' => function (Membre $membre) {
                    return $membre->getPrenom() . ' ' . $membre->getNom() . ' (' . $membre->getEmail() . ')';
                },
                'label' => 'Membre',
                'attr' => ['class' => 'form-control']
            ])
            ->add('vehicule', EntityType::class, [
                'class' => Vehicule::class,
                'choice_label' => 'titre',
                'label' => 'Véhicule',
                'attr' => ['class' => 'form-control']
            ])
            ->add('dateHeureDepart', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date et heure de départ',
                'attr' => ['class' => 'form-control']
            ])
            ->add('dateHeureFin', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date et heure de fin',
                'attr' => ['class' => 'form-control']
            ])
            ->add('prixTotal', MoneyType::class, [
                'label' => 'Prix total',
                'attr' => ['class' => 'form-control']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
