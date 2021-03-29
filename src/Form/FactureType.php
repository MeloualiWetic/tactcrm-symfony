<?php

namespace App\Form;

use App\Entity\Facture;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('utilisateur',EntityType::class,['class'=> 'App\Entity\Utilisateur',
                'query_builder' => function (EntityRepository  $repository){
                    return $repository->createQueryBuilder('p')
                        ->andWhere('p.roles != :val')
                        ->setParameter('val', '["ROLE_ADMIN"]')
                        ;
                }] )
            ->add('dateFacturation',DateType::class,[
                'widget' => 'single_text'])
            ->add('numero')
            ->add('statut',null,[
                'label' => false,
            ])
            ->add('description')
            ->add('devise',EntityType::class,['class'=> 'App\Entity\Devise'] )
            ->add('typePaiement',EntityType::class,['class'=> 'App\Entity\TypePaiement'] )
            ->add('detailFactures',  CollectionType::class, [
                'entry_type' => DetailFactureType::class,
                'label' => false,
                'entry_options' => [
                    'label' => false
                ],
                'by_reference' => false,
                // this allows the creation of new forms and the prototype too
                'allow_add' => true,
                // self explanatory, this one allows the form to be removed
                'allow_delete' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}



