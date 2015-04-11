<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RecommandationExperienceController
 *
 * @author Aminovski
 */
namespace BestTrip\WeeGoBundle\Controller;
use \Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \BestTrip\WeeGoBundle\Entity\RecommandationExperience;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RecommandationExperienceController extends Controller{
    public function ajoutAction($idE,$idU,$note,$texte){
        
        $recommandationE = new RecommandationExperience();
         $date = \DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
        
        $em = $this->getDoctrine()->getManager();
        $exp = $em->getRepository('BestTripWeeGoBundle:Experience')->findOneById($idE);
       
        $utilisateur = $em->getRepository('BestTripWeeGoBundle:FosUser')->findOneById($idU);
        $recommandationE->setIdExperience($exp);
        $recommandationE->setNote($note);
        $recommandationE->setTexte($texte);
        $recommandationE->setUtilisateur($utilisateur);
        $recommandationE->setDateRecommandation($date);
        //die($note);
        
        if($idE!="" && $note != "" && $texte != "" && $idU!=""){
            
             $em->getRepository('BestTripWeeGoBundle:RecommandationExperience');
            $em->persist($recommandationE);
            $em->flush();
            
            $recommandations = $em->getRepository('BestTripWeeGoBundle:RecommandationExperience')->findBy(array('idExperience'=>$exp),array('id' => 'DESC'));
            
            $user = array();
            $rec = array();
            $dateP = array();
            $note = array();
            
            foreach ($recommandations as $r){
                $user[] = $r->getUtilisateur()->getPseudo();
                $rec[] = $r->getTexte();
                $dateP[] = $r->getDateRecommandation()->format('d/m/Y');
                $note[] = $r->getNote();
            }
            
            //var_dump($user);
            //die();
            
            $reponse = new JsonResponse();
            
            return $reponse->setData(array('user'=>$user,'rec'=>$rec,'dateP'=>$dateP,'note'=>$note));
           // return $this->redirect($this->generateUrl('best_trip_wee_go_infoLieu',array('id'=>$idL)));
        }
        //var_dump('hello');
        //return $this->redirect($this->generateUrl('best_trip_wee_go_infoLieu',array('id'=>$id,'statut'=>$statut)));
        return new Response("Erreur lors de la recommandation");       
    }
    
    public function supprimerRecExpAdminAction($id,$idE){
        $em = $this->getDoctrine()->getManager();
        $recommandation = $em->getRepository('BestTripWeeGoBundle:RecommandationExperience')->findOneById($id);

        $em->remove($recommandation);
        $em->flush();
        return $this->redirect($this->generateUrl('afExperienceAdmin',array('id'=>$idE)));
    }
    
    public function mesRecommandationsAction($idU){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('BestTripWeeGoBundle:FosUser')->findOneById($idU);
        $recommandations = $em->getRepository('BestTripWeeGoBundle:RecommandationExperience')->findBy(array('utilisateur'=>$user),array('id' => 'DESC'));
        //var_dump($etudiants);
        return $this->render('BestTripWeeGoBundle:Recommandation:MesRecommandationsExp.html.twig', array('recommandations' => $recommandations));
    }
    
    public function supprimerRecExpAction($id,$idU){
        $em = $this->getDoctrine()->getManager();
        $recommandation = $em->getRepository('BestTripWeeGoBundle:RecommandationExperience')->findOneById($id);

        $em->remove($recommandation);
        $em->flush();
        return $this->redirect($this->generateUrl('mesRecommandationsExp',array('idU'=>$idU)));
    }
    
    public function aVoteAction($idU,$idE){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('BestTripWeeGoBundle:FosUser')->findOneById($idU);
        $exp = $em->getRepository('BestTripWeeGoBundle:Experience')->findOneById($idE);
        $recommandations = $em->getRepository('BestTripWeeGoBundle:RecommandationExperience')->findBy(array('utilisateur'=>$user,'idExperience'=>$exp));
        
        
        if($recommandations == null){
            return new Response("true"); 
        } else{
            return new Response("false"); 
        }

        
    }
    
}
