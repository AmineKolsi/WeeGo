<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of rechercheParAnneeType
 *
 * @author Aminovski
 */
namespace BestTrip\GrapheBundle\Form;
use \Symfony\Component\Form\AbstractType;
use \Symfony\Component\Form\FormBuilderInterface;

class RechercheParAnneeType extends AbstractType{
    public function getName() {
        return "formulaireRechercheParAnnee";
    }
    
    public  function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('annee')->add('Rechercher','submit');
    }


}
