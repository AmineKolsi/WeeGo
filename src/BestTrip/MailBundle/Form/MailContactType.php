<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MailType
 *
 * @author Nanou
 */
namespace BestTrip\MailBundle\Form;

use Symfony\Component\Form\AbstractType; 
use Symfony\Component\Form\FormBuilderInterface; 
use Symfony\Component\OptionsResolver\OptionsResolverInterface; 
class MailContactType extends AbstractType 
{ 
    public function buildForm(FormBuilderInterface $builder, array $options) 
    { 
        $builder 
            
            ->add('email', 'email')    
            ->add('subject','text',array('label' => 'Sujet'))     
            ->add('message', 'textarea') 
           // ->add('file','file')    
        ; 
    } 
    public function getName() 
    { 
        return 'MailContact'; 
    } 
} 