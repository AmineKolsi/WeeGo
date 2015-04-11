<?php
namespace BestTrip\WeeGoBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BestTrip\WeeGoBundle\Entity\Contribution;
use BestTrip\WeeGoBundle\Form\ContributionForm;
use Symfony\Component\HttpFoundation\Request;
class ContributionController extends Controller{
      public function afficherContributionAction()
  {   
      $em=$this->getDoctrine()->getManager();
      $contribution=$em->getRepository('BestTripWeeGoBundle:Contribution')->findAll();
      return $this->render('BestTripWeeGoBundle:Contribution:afficherContributionAdmin.html.twig',array('contribution'=>$contribution));
  }
   public function ajouterContributionAction(Request $request,$id)
  {
      $contribution = new Contribution();
      $f=new \BestTrip\WeeGoBundle\Form\ContributionForm();
      $form=$this->createForm($f,$contribution);
      if($form->handleRequest($request)->isValid())
             {
                     $em=$this->getDoctrine()->getManager();
                     $em->persist($contribution);
                     $em->flush();
                    return $this->redirect($this->generateUrl('afficher_guide_detail',array('id'=>$id)));
                    }
             
       return $this->render('BestTripWeeGoBundle:Contribution:ajouter.html.twig',array('form'=>$form->createView()));
  }

  public function supprimerContributionAction($id)
  {
       $em=$this->getDoctrine()->getManager();
       $contribution=$em->getRepository('BestTripWeeGoBundle:Contribution')->find($id);
       $em->remove($contribution); 
       $em->flush();
       return  $this->redirect($this->generateUrl('afficher_contribution'));
  }
}
