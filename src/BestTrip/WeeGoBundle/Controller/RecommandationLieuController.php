<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RecommandationLieuController
 *
 * @author Aminovski
 */

namespace BestTrip\WeeGoBundle\Controller;
use \Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \BestTrip\WeeGoBundle\Entity\RecommandationLieu;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RecommandationLieuController extends Controller{
    
    /*public function ajoutAction($idU,$note,$texte,$idL){
        $recommandationL = new RecommandationLieu();
        $date = date('d/m/Y');
        //$recommandationL->setDateRecommandation($date);
        $em = $this->getDoctrine()->getManager();
        $lieu = $em->getRepository('BestTripWeeGoBundle:Lieu')->findOneById($idL);
        $utilisateur = $em->getRepository('BestTripWeeGoBundle:Utilisateur')->findOneById($idU);
        $recommandationL->setIdLieu($lieu);
        $recommandationL->setNote($note);
        $recommandationL->setTexte($texte);
        $recommandationL->setUtilisateur($utilisateur);
        $response = new JsonResponse();
        //die($recommandationL->getIdLieu());
        //print_r($response);exit();
        if ($recommandationL->getDateRecommandation() != "" && $recommandationL->getIdLieu() != "" && $recommandationL->getNote() != "" && $recommandationL->getTexte()!="") {
            
            $em->getRepository('BestTripWeeGoBundle:RecommandationLieu');
            $em->persist($recommandationL);
            $em->flush();
            
            
            
        }
        return $this->redirect($this->generateUrl('best_trip_wee_go_infoLieu'));
//$response->setData(array('recommandationL'=>$recommandationL));
    }*/
    
    public function ajoutAction($idL,$idU,$note,$texte){
        //$requete = $this->container->get('request');
        
        /*$idL = $requete->get('idL');
        $idU = $requete->get('idU');
        $note = $requete->get('note');
        $texte = $requete->get('texteR');*/
        
        $recommandationL = new RecommandationLieu();
         $date = \DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
        
        $em = $this->getDoctrine()->getManager();
        $lieu = $em->getRepository('BestTripWeeGoBundle:Lieu')->findOneById($idL);
        $utilisateur = $em->getRepository('BestTripWeeGoBundle:FosUser')->findOneById($idU);
        $recommandationL->setIdLieu($lieu);
        $recommandationL->setNote($note);
        $recommandationL->setTexte($texte);
        $recommandationL->setUtilisateur($utilisateur);
        $recommandationL->setDateRecommandation($date);
        //die($note);
        
        if($idL!="" && $note != "" && $texte != "" && $idU!=""){
             $em->getRepository('BestTripWeeGoBundle:RecommandationLieu');
            $em->persist($recommandationL);
            $em->flush();
            
            $recommandations = $em->getRepository('BestTripWeeGoBundle:RecommandationLieu')->findBy(array('idLieu'=>$lieu),array('id' => 'DESC'));
            
            $user = array();
            $rec = array();
            $dateP = array();
            $note = array();
            
            foreach ($recommandations as $r){
                $user[] = $r->getUtilisateur()->getUsername();
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
        return new Response("false");       
    }
    
    public function mesRecommandationsAction($idU){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('BestTripWeeGoBundle:FosUser')->findOneById($idU);
        $recommandations = $em->getRepository('BestTripWeeGoBundle:RecommandationLieu')->findBy(array('utilisateur'=>$user),array('id' => 'DESC'));
        //var_dump($etudiants);
        return $this->render('BestTripWeeGoBundle:Recommandation:MesRecommandationsLieu.html.twig', array('recommandations' => $recommandations));
    }
    
    public function supprimerAction($id,$idU){
        $em = $this->getDoctrine()->getManager();
        $recommandation = $em->getRepository('BestTripWeeGoBundle:RecommandationLieu')->findOneById($id);

        $em->remove($recommandation);
        $em->flush();
        return $this->redirect($this->generateUrl('mesRecommandations',array('idU'=>$idU)));
    }
    
    
    public function supprimerAdminAction($id,$idL,$statut){
        $em = $this->getDoctrine()->getManager();
        $recommandation = $em->getRepository('BestTripWeeGoBundle:RecommandationLieu')->findOneById($id);

        $em->remove($recommandation);
        $em->flush();
        return $this->redirect($this->generateUrl('info_lieu_admin',array('id'=>$idL,'statut'=>$statut)));
    }
    
    public function aVoteAction($idU,$idL){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('BestTripWeeGoBundle:FosUser')->findOneById($idU);
        $lieu = $em->getRepository('BestTripWeeGoBundle:Lieu')->findOneById($idL);
        $recommandations = $em->getRepository('BestTripWeeGoBundle:RecommandationLieu')->findBy(array('utilisateur'=>$user,'idLieu'=>$lieu));
        
        
        if($recommandations == null){
            return new Response("true"); 
        } else{
            return new Response("false"); 
        }

        
    }
    
     
}
