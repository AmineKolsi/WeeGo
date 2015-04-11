<?php
namespace BestTrip\WeeGoBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BestTrip\WeeGoBundle\Entity\Guide;
use BestTrip\WeeGoBundle\Form\GuideForm;
use BestTrip\WeeGoBundle\Form\GuideForm2;
class GuideController extends Controller{
  public function afficherGuideAction()
  {   
      $em=$this->getDoctrine()->getManager();
      $guide=$em->getRepository('BestTripWeeGoBundle:Guide')->findAll();
      return $this->render('BestTripWeeGoBundle:Guide:afficher.html.twig',array('guide'=>$guide));
  }
  public function afficherGuideUtilisateur1Action()
  {  
       $em=$this->getDoctrine()->getManager();
      $guide=$em->getRepository('BestTripWeeGoBundle:Guide')->findAll();
      $cpt= 0;
      foreach($guide as $c) 
      {
      $c->getIdG();
      $em=$this->getDoctrine()->getManager();
      $guides[$cpt]=$em->getRepository('BestTripWeeGoBundle:Guide')->find1All($c);
      $cpt++;
       }

  
      return $this->render('BestTripWeeGoBundle:Guide:afficherGuideUtilisateur1.html.twig',array('guide'=>$guide,'guides'=>$guides));
  }
 
   public function afficherGuideDetailAction($id)
  {   
      $em=$this->getDoctrine()->getManager();
      $guide=$em->getRepository('BestTripWeeGoBundle:Guide')->find($id);
      $contribution=$em->getRepository('BestTripWeeGoBundle:Contribution')->findBy(array('idGuide'=>$guide));
      return $this->render('BestTripWeeGoBundle:Guide:afficherDetail.html.twig',array('guide'=>$guide,'contribution'=>$contribution));
  }
  public function ajouterGuideAction()
  {
      $guide = new Guide();
      $f=new GuideForm();
      $form=$this->createForm($f,$guide);
      $request=$this->get('request');
      if($form->handleRequest($request)->isValid())
             {
            
                     $em=$this->getDoctrine()->getManager();
                     $em->persist($guide);
                     $em->flush();
                     return $this->redirect($this->generateUrl('afficher_guide'));
                  
             }
       return $this->render('BestTripWeeGoBundle:Guide:ajouter.html.twig',array('form'=>$form->createView()));
  }
  public function modifierGuideAction($id)
  {
      $em=$this->getDoctrine()->getManager();
      $guide=$em->getRepository('BestTripWeeGoBundle:Guide')->find($id);
      $f=new GuideForm2();
      $form=$this->createForm($f,$guide);
      $request=$this->get('request');
      if($request->getMethod()=="POST")
            {
             $form->bind($request); //relié formulaire -> requete
             if($form->isValid())
                  {
              
                    $em->persist($guide);
                    $em->flush();
                    return $this->redirect($this->generateUrl('afficher_guide'));
                  }
            }
      return $this->render('BestTripWeeGoBundle:Guide:modifier.html.twig',array('form'=>$form->createView(),'guide'=>$guide));
  }
  public function supprimerGuideAction($id)
  {
       $em=$this->getDoctrine()->getManager();
       $guide=$em->getRepository('BestTripWeeGoBundle:Guide')->find($id);
       $em->remove($guide); 
       $em->flush();
       return  $this->redirect($this->generateUrl('afficher_guide'));
  }
  public function rechercherGuideAction($titre)
  {
      
          
            $em=$this->getDoctrine()->getManager();
            $guides=$em->getRepository('BestTripWeeGoBundle:Guide')->findBy(array('titre'=>$titre)); 
            $guidess=$em->getRepository('BestTripWeeGoBundle:Guide')->find1All(array($guides));
            return $this->render('BestTripWeeGoBundle:Guide:afficherGuideUtilisateur1.html.twig',array('guide'=>$guides,'titre'=>$titre,'guides'=>$guidess));
        
  }
  
  public function afficherGuideUtilisateur1FrontAction()
  {  
       $em=$this->getDoctrine()->getManager();
      $guide=$em->getRepository('BestTripWeeGoBundle:Guide')->findAll();
      $cpt= 0;
      foreach($guide as $c) 
      {
      $c->getIdG();
      $em=$this->getDoctrine()->getManager();
      $guides[$cpt]=$em->getRepository('BestTripWeeGoBundle:Guide')->find1All($c);
      $cpt++;
       }

  
      return $this->render('BestTripWeeGoBundle:Front:afficherGuideUtilisateur1_front.html.twig',array('guide'=>$guide,'guides'=>$guides));
  }
  
  public function afficherGuideDetailFrontAction($id)
  {   
      $em=$this->getDoctrine()->getManager();
      $guide=$em->getRepository('BestTripWeeGoBundle:Guide')->find($id);
      $contribution=$em->getRepository('BestTripWeeGoBundle:Contribution')->findBy(array('idGuide'=>$guide));
      return $this->render('BestTripWeeGoBundle:Front:afficherDetailFront.html.twig',array('guide'=>$guide,'contribution'=>$contribution));
  }
 
  
}
