<?php
 
namespace BestTrip\WeeGoBundle\Form;

use \Symfony\Component\Form\AbstractType;
use \Symfony\Component\Form\FormBuilderInterface;

class RestaurantForm extends AbstractType{
   
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
       $builder->add('idVille','entity',array("class"=>"BestTripWeeGoBundle:Ville",
                    
                   "label"=>"Nom Ville:"))
                ->add('nom' ,'text', array('label'=>'Nom :'))
                  
                    ->add('file' ,'file', array('label'=>'Image :'))
                ->add('adresse','text', array('label'=>'Adresse :'))
                ->add('numtel','number', array('label'=>'Numero Telephone :'))
                ->add('siteweb','text', array('label'=>'Site Web :'))
                ->add('specialite','text', array('label'=>'Spécialité :'))
                ->add('reservation','choice' ,array(
    'choices'   => array('oui' => 'Oui', 'non' => 'Non'),
    'required'  => true,
    'label'=>'Reservation :'
))
                ->add('jRepos','text', array('label'=>'Jours Repos :'))
                ->add('Ajouter','submit');
  
        } 

  public function getName() {
        
    }
}
