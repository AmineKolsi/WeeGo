<?php

namespace BestTrip\WeeGoBundle\Form;

use \Symfony\Component\Form\AbstractType;
use \Symfony\Component\Form\FormBuilderInterface;

class ExperienceForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('titre')
                ->add('date_debut', 'date')
                ->add('date_fin', 'date')
                ->add('impression')
                ->add('idLieu')
                ->add('texte')
                ->add('image', 'file', array(
                'data_class' => null
            ))
        ;
    }

    public function getName() {
        
    }

}
