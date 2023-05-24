<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', TextType::class, [
                'label' => 'Nom et Prénom'
            ])
            ->add('campany', TextType::class, [
                'label' => 'Campanie'
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse'
            ])
            ->add('complement', TextType::class, [
                'label' => 'Complément'
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone'
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville'
            ])
            ->add('codePostal', TextType::class, [
                'label' => 'Code Postale'
            ])
            ->add('country', CountryType::class, [
                'label' => 'Pays'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
