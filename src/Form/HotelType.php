<?php

namespace App\Form;

use App\Entity\Hotel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HotelType extends AbstractType
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
            ->add('nom', TextType::class, $this->getConfiguration("Nom de l'hotel", "Donnez le nom de l'hotel"))
            ->add('ville', TextType::class, $this->getConfiguration("Ville", "Donnez le nom de la ville"))
            ->add('description', TextType::class, $this->getConfiguration("Description", "Description de l'hotel"))
            ->add('adresse', TextType::class, $this->getConfiguration("Adresse", "Adresse de l'hotel"))
            ->add('photoHotel', UrlType::class, $this->getConfiguration("Photo de l'hotel", "Image de l'hotel"))
            ->add('contact', TextType::class, $this->getConfiguration("Contact de l'hotel", "Contact de l'hotel"))
            ->add('slug', TextType::class, $this->getConfiguration("Slug", "Slug de l'hotel (Automatique)"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hotel::class,
        ]);
    }
}
