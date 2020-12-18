<?php

namespace App\Form;

use App\Entity\DetailFacture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailFactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id',HiddenType::class ,array('label' => false,'required' => false, 'mapped' => false,))
            ->add('designationProduit',TextType::class,array('label' => false))
            ->add('qte',TextType::class,array('label' => false))
            ->add('prixVente',TextType::class,array('label' => false))
            ->add('article',EntityType::class,['class'=> 'App\Entity\Article','label' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DetailFacture::class,
        ]);
    }
}
