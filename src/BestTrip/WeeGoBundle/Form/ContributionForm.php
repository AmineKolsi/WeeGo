<?php
namespace BestTrip\WeeGoBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class ContributionForm extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder ->add('idUtilisateur','entity',array('class'=>'BestTripWeeGoBundle:Utilisateur','property'=>'pseudo'))
                  ->add('idGuide','entity',array('class'=>'BestTripWeeGoBundle:Guide','property'=>'idPays'))
                  ->add('titre')
                  ->add('texte');
     }
    public function getName() {
        return "Contribution";
    }


}
