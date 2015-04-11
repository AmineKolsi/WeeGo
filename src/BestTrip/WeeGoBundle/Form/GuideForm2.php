<?php
namespace BestTrip\WeeGoBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class GuideForm2 extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $date = \DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
          $builder->add('titre')
                  ->add('dateCreation','date')
                  ->add('dateModification', 'date', array( 'data' => $date))
                  ->add('texte')
                  ->add('idAdministrateur','entity',array('class'=>'BestTripWeeGoBundle:Administrateur','property'=>'login'))
                  ->add('idPays','entity',array('read_only'=>true,'class'=>'BestTripWeeGoBundle:Pays','property'=>'nomPays'))
                  ->add('file', 'file');
     }
    public function getName() {
        return "Guide";
    }

}
