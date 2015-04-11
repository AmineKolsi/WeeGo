<?php

namespace BestTrip\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BestTrip\UserBundle\Entity\Utilisateur;


class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BestTripUserBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function ContactAction()
    {
        return $this->render('BestTripUserBundle::contact.html.twig');
    }
    public function homeAction()
    {
        return $this->render('BestTripWeeGoBundle:Utilisateur:AdminMenu.html.twig');
    }
    public function homepageAction()
    {
        return $this->render('BestTripWeeGoBundle::layout.html.twig');
    }
    
    public function profileAction()
    {    
        return $this->render('BestTripUserBundle:Profile:profile.html.twig');
    }
    
   public function usersAction() {
        //access user manager services 

          $userManager = $this->get('fos_user.user_manager');
          
         $users =$userManager->findUsers();
          
          
            //var_dump(unserialize($users));
     
        return $this->render('BestTripUserBundle::users.html.twig', array('users' =>$users));
    }
    
    public function  supprimerAction($username){
         $userManager = $this->get('fos_user.user_manager');
         $em=$this->getDoctrine()->getManager();
          $users = $userManager->findUserByUsername($username);
         
         $userManager->deleteUser($users);
             $em->flush();
                   
        return $this->redirect($this->generateUrl('wee_go_users'));
         
    }
}
