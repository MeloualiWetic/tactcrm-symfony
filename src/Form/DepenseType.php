<?php

namespace App\Form;

use App\Entity\Depense;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;



class DepenseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('dateDepense',DateType::class,[
                'widget' => 'single_text'])
            ->add('nontant')
            ->add('description')
            ->add('devise',EntityType::class,['class'=> 'App\Entity\Devise'] )
            ->add('typePaiement',EntityType::class,['class'=> 'App\Entity\TypePaiement'] )
            ->add('typeDepense',EntityType::class,['class'=> 'App\Entity\TypeDepense'] )


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Depense::class,
        ]);
    }
}
