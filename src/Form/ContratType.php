<?php

namespace App\Form;

use App\Entity\Contrat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class ContratType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sujet')
            ->add('dateDebut',DateType::class,[
                'widget' => 'single_text'])
            ->add('dateFin',DateType::class,[
                'widget' => 'single_text'])
            ->add('description')
            ->add('typeContrat')
            ->add('utilisateur',EntityType::class,['class'=> 'App\Entity\Utilisateur',
            'query_builder' => function (EntityRepository  $repository){
                return $repository->createQueryBuilder('p')
                    ->andWhere('p.roles != :val')
                    ->setParameter('val', '["ROLE_ADMIN"]')
                    ;
            }] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contrat::class,
        ]);
    }
}
