<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RecommandationLieuForm
 *
 * @author Aminovski
 */
namespace BestTrip\WeeGoBundle\Form;

use \Symfony\Component\Form\AbstractType;
use \Symfony\Component\Form\FormBuilderInterface;

class RecommandationLieuForm extends AbstractType{
    public function getName() {
        return "recommandationLieuForm";
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('idLieu')->add('texte')->add('Ajouter','submit');
    }

//put your code here
}
