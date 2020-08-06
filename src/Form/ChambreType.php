<?php

namespace App\Form;

use App\Entity\Hotel;
use App\Entity\Chambre;
use App\Entity\Comodite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ChambreType extends AbstractType
{
    /**
     * Permet de donner la configuration de base du formulaire
     */
    private function getConfiguration($label, $placeholder)
    {
        return [
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder

            ]
        ];
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroChambre', IntegerType::class, $this->getConfiguration("Numéro de chambre", "Donnez le numéro de la chambre"))
            ->add('etage', IntegerType::class, $this->getConfiguration("A quel étage se trouve la chambre", "Entrez le numéro d'étage de la chambre"))
            ->add('photochambre', TextType::class, $this->getConfiguration("iMAGE", "Selectionner une image"))
            // ->add('photochambre', FileType::class, [
            //     'label' => 'Choisisez une image'
            // ])
            ->add('prix', IntegerType::class, $this->getConfiguration("Prix de la chambre", "Donnez le prix de la chambre"))
            ->add('chambreHotel', EntityType::class, [
                'label' => 'Selectionnez l\'hotel associé à cette chambre',
                'class' => Hotel::class,
                'choice_label' => 'nom',

            ])
            ->add('comoditeChambre', EntityType::class, [
                'label' => 'Selectionnez les comodités de la chambre',
                'class' => Comodite::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chambre::class,
        ]);
    }
}
