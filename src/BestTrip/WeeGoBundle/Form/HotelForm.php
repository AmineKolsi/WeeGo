<?php
 
namespace BestTrip\WeeGoBundle\Form;

use \Symfony\Component\Form\AbstractType;
use \Symfony\Component\Form\FormBuilderInterface;

class HotelForm extends AbstractType{
   
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('idVille','entity',array("class"=>"BestTripWeeGoBundle:Ville",
                    
                   "label"=>"Nom Ville:"))
                ->add('nom' ,'text', array('label'=>'Nom :'))
                ->add('file' ,'file', array('label'=>'Image :'))
 
                ->add('adresse','text', array('label'=>'Adresse :'))
                ->add('numtel','number', array('label'=>'Numero Telephone :'))
                ->add('siteweb','text', array('label'=>'Site Web :'))
                ->add('nbrEtoiles','text', array('label'=>'Nombre Des Etoiles :'))
                ->add('service','text', array('label'=>'Service :'))
                ->add('emplacement','text', array('label'=>'Emplacement :'))
                ->add('Ajouter','submit');
  
        }

  public function getName() {
        
    }
}
