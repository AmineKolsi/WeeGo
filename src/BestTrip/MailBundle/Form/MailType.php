<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MailType
 *
 * @author Aminovski
 */

namespace BestTrip\MailBundle\Form;

use \Symfony\Component\Form\AbstractType;
use \Symfony\Component\Form\FormBuilderInterface;

class MailType extends AbstractType {

   
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
           // ->add('email', 'email')   
                
           // ->add('email','entity',array('class'=>'BestTripUserBundle:Utilisateur','property'=>'email'))                 
             ->add('email','email')                 
            ->add('subject','text',array('label' => 'Sujet'))     
            ->add('message', 'textarea') 
            //->add('file','file')   

        ;
    }
    
     public function getName() {
        return "MailType";
    }

}
