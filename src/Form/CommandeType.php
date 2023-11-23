<?php
namespace App\Form;

use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // Utilisez IntegerType si vous voulez que les utilisateurs saisissent l'ID manuellement
            ->add('idMembre', IntegerType::class, [
                'label' => 'ID Membre',
                'attr' => ['class' => 'form-control']
            ])
            ->add('idVehicule', IntegerType::class, [
                'label' => 'ID Véhicule',
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
