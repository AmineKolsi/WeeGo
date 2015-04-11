<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModifierProfileFormType
 *
 * @author Nanou
 */
namespace BestTrip\UserBundle\Form;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use MyApp\UserBundle\Entity\Utilisateur;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ModifierProfileFormType extends BaseType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        parent::buildForm($builder, $options);
               $date = \DateTime::createFromFormat('Y-m-d', date('Y-m-d'));

        $builder
             ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
             ->add('prenom',null,array('label' => 'Prenom : '))
             ->add('pseudo',null,array('label' => 'Pseudo : '))
             ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            // ->add('pays',null,array('label' => 'Pays : '))
             ->add('pays','entity',array('class'=>'BestTripWeeGoBundle:Pays','property'=>'nomPays'))  
             ->add('date_naissance','birthday',array('label' => 'date_naissance: '))       
             ->add('date_inscrit','date',array('data' =>$date))
             ->add('file', 'file')  

        ;
    }
    
    public function getName()
    {
        return 'best_trip_user_profile';
    }
}
