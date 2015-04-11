<?php
namespace BestTrip\WeeGoBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class GuideForm extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $date = \DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
          $builder->add('titre')
                  ->add('dateCreation','date',array( 'data' => $date))
                  ->add('dateModification', 'date', array( 'data' => $date))
                  ->add('texte')
                  ->add('idAdministrateur','entity',array('class'=>'BestTripWeeGoBundle:Administrateur','property'=>'login'))
                  ->add('idPays','entity',array('class'=>'BestTripWeeGoBundle:Pays','property'=>'nomPays'))
                  ->add('file', 'file');
     }
    public function getName() {
        return "Guide";
    }

}
