<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegistrationFormType
 *
 * @author Nanou
 */
namespace BestTrip\UserBundle\Form;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

//use Symfony\Component\Validator\Constraints\DateTime;
use Zend\Stdlib\DateTime;
class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $date = \DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
        $Role=
        $builder
                        
                ->add('prenom','text',array('label' => 'Prenom'))                 
                ->add('pays','entity',array('class'=>'BestTripWeeGoBundle:Pays','property'=>'nomPays'))              
                ->add('pseudo','text',array('label' => 'Pseudo'))       
                ->add('date_naissance','birthday',array('label' => 'date_naissance'))       
                ->add('date_inscrit','date',array('data' =>$date))
                ->add('roles', 'collection', array(
                   'type' => 'choice',
                   'options' => array(
                       'label' => false, /* Ajoutez cette ligne */
                       'choices' => array(            
                           'ROLE_UTILISATEUR' => 'user'
                       )
                   )
                
               )
           )
                
            ->add('file', 'file')
    
    ;
       

        
        
    }
 
    public function getName()
    {
        return 'best_trip_user_registration';
    }
}
    

