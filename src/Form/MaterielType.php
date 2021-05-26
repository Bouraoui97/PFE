<?php

namespace App\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Unite;
use App\Entity\Materiel;
use App\Entity\Inventaire;
use App\Entity\BonDeCommande;
use App\Entity\Intervention;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('date_dacquisition')
            ->add('affectation')
            ->add('etat')
            ->add('unite',EntityType::class,['class'=>Unite::class,'choice_label'=>'name'])
            ->add('inventaire',EntityType::class,['class'=>Inventaire::class,'choice_label'=>'id'])
            ->add('bon_de_commande',EntityType::class,['class'=>BonDeCommande::class,'choice_label'=>'numbc'])
            ->add('intervention',EntityType::class,['class'=>Intervention::class,'choice_label'=>'id'])
        ;
    }

// public function buildForm(FormBuilderInterface $builder, array $options)
        // {
        //     $builder
        //         ->add('name')
        //         ->add('surname')
        //         ->add('age')
        //         ->add('email')
        //         ->add('adress')
        //         ->add('unite',EntityType::class,['class'=>Unite::class,'choice_label'=>'name','expanded'=>true])
        //         ->add('Save',SubmitType::class)   
        //     ;
        // }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Materiel::class,
        ]);
    }
}
