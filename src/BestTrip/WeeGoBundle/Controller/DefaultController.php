<?php

namespace BestTrip\WeeGoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \BestTrip\GrapheBundle\Form\RechercheParAnneeType;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BestTripWeeGoBundle:Default:index.html.twig', array('name' => $name));
    }
    
     public function acceuilAction()
    {
        return $this->redirect($this->generateUrl('fos_user_security_login'));
    }
    
    public function rechercheAction(){
        $form = $this->createForm(new RechercheParAnneeType());
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {

            $form->bind($request);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $data = $this->getRequest()->request->get('formulaireRechercheParAnnee');
                
                $experiences = $em->getRepository('BestTripWeeGoBundle:Experience')->findByDatePublication($data);
                
                
                return $this->render('BestTripGrapheBundle:Experiences:ListeExperiences.html.twig', array('form' => $form->createView(), 'experiences' => $experiences));
            }
        }

       return $this->render('BestTripGrapheBundle:Experiences:ListeExperiences.html.twig', array('form' => $form->createView(), 'experiences' => null));
    }
}
