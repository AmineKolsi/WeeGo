<?php

namespace BestTrip\WeeGoBundle\Controller;

use BestTrip\WeeGoBundle\Entity\Experience;
use \Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BestTrip\WeeGoBundle\Form\ExperienceForm;
class ExperienceController extends Controller {

    public function ajouterAction() {
        $e = new Experience();
        $e->setVideo('');
        $e->setDatePublication(new \Datetime());
        $ef = new ExperienceForm();
        $form = $this->createForm($ef, $e);
        $request = $this->get('request');
        $form->handleRequest($request);
        if ($request->getMethod() == 'POST') {
            $em = $this->getDoctrine()->getManager();
            $stream = fopen("C:\Users\Aminovski\Desktop\\" . $e->getImage(), 'rb');
            $e->setImage(stream_get_contents($stream));
            $em->persist($e);
            $em->flush();
            return $this->redirect($this->generateUrl('showExperience'));
        }
        return $this->render('BestTripWeeGoBundle:Experience:ajouter.html.twig', array('form' => $form->createView()));
    }

    public function afficherAction() {
        $em = $this->getDoctrine()->getManager();
        $experience = $em->getRepository('BestTripWeeGoBundle:Experience')->findAll();
        return $this->render('BestTripWeeGoBundle:Experience:afficher.html.twig', array('experience' => $experience));
    }

    public function showAction() {
        $em = $this->getDoctrine()->getManager();
        $experience = $em->getRepository('BestTripWeeGoBundle:Experience')->findAll();
        $images = array();
        foreach ($experience as $key => $entity) {
            $images[$key] = base64_encode(stream_get_contents($entity->getImage()));
        }
        return $this->render('BestTripWeeGoBundle:Experience:show.html.twig', array(
                    'experience' => $experience,
                    'images' => $images,
        ));
    }

    public function supprimerAction($id) {
        $em = $this->getDoctrine()->getManager();
        $ex = $em->getRepository('BestTripWeeGoBundle:Experience')->findOneById($id);
        $em->remove($ex);
        $em->flush();
        return $this->redirect($this->generateUrl('afficherExperience'));
    }
    public function supprimer2Action($id) {
        $em = $this->getDoctrine()->getManager();
        $ex = $em->getRepository('BestTripWeeGoBundle:Experience')->findOneById($id);
        $em->remove($ex);
        $em->flush();
        return $this->redirect($this->generateUrl('showExperience'));
    }
    public function afAction($id) {
        $em = $this->getDoctrine()->getManager();
        $experience = $em->getRepository('BestTripWeeGoBundle:Experience')->findById($id);
        $recommandations = $em->getRepository('BestTripWeeGoBundle:RecommandationExperience')->findBy(array('idExperience' => $experience), array('id' => 'DESC'));
        ;

        $images = array();
        foreach ($experience as $key => $entity) {
            $images[$key] = base64_encode(stream_get_contents($entity->getImage()));
        }
        return $this->render('BestTripWeeGoBundle:Experience:af.html.twig', array(
                    'experience' => $experience,
                    'images' => $images,
                    'recommandations' => $recommandations
        ));
    }

    public function afAdminAction($id) {
        $em = $this->getDoctrine()->getManager();
        $experience = $em->getRepository('BestTripWeeGoBundle:Experience')->findById($id);
        $recommandations = $em->getRepository('BestTripWeeGoBundle:RecommandationExperience')->findBy(array('idExperience' => $experience), array('id' => 'DESC'));
        $images = array();
        foreach ($experience as $key => $entity) {
            $images[$key] = base64_encode(stream_get_contents($entity->getImage()));
        }
        return $this->render('BestTripWeeGoBundle:Experience:afAdmin.html.twig', array(
                    'experience' => $experience,
                    'images' => $images,
                    'recommandations' => $recommandations
        ));
    }

    public function rechercherAction($rechercher) {
        $em = $this->getDoctrine()->getManager();
        $experience = $em->getRepository('BestTripWeeGoBundle:Experience')->findByTitre($rechercher);
        $images = array();
        foreach ($experience as $key => $entity) {
            $images[$key] = base64_encode(stream_get_contents($entity->getImage()));
        }
        return $this->render('BestTripWeeGoBundle:Experience:show.html.twig', array(
                    'experience' => $experience,
                    'images' => $images,
        ));
    }

    public function mesexperienceAction($id) {
        $em = $this->getDoctrine()->getManager();
        $experience = $em->getRepository('BestTripWeeGoBundle:Experience')->findByidAuteur($id);
        $images = array();
        foreach ($experience as $key => $entity) {
            $images[$key] = base64_encode(stream_get_contents($entity->getImage()));
        }
        return $this->render('BestTripWeeGoBundle:Experience:mesexper.html.twig', array(
                    'experience' => $experience,
                    'images' => $images,
        ));
    }

    public function modifierAction($id) {
        $em = $this->getDoctrine()->getManager();
        $experience = $em->getRepository('BestTripWeeGoBundle:Experience')->findOneById($id);
        $ef = new ExperienceForm();
        $form = $this->createForm($ef, $experience);
        $request = $this->get('request');
        $form->handleRequest($request);
        if ($request->getMethod() == 'POST') {
            $em = $this->getDoctrine()->getManager();
            $em->getRepository('BestTripWeeGoBundle:Experience');
            $stream = fopen("C:\Users\Malek\Desktop\\" . $experience->getImage(), 'rb');
            $experience->setImage(stream_get_contents($stream));
            $em->persist($experience);
            $em->flush();
            return $this->redirect($this->generateUrl('showExperience'));
        }
        return $this->render('BestTripWeeGoBundle:Experience:modifier.html.twig', array('form' => $form->createView(), 'experience' => $experience));
    }

    public function affichermesExperienceAction($id) {
        $em = $this->getDoctrine()->getManager();
        $experience = $em->getRepository('BestTripWeeGoBundle:Experience')->findAll();
        $images = array();
        foreach ($experience as $key => $entity) {
            $images[$key] = base64_encode(stream_get_contents($entity->getImage()));
        }
        return $this->render('BestTripWeeGoBundle:Experience:affichermesExperience.html.twig', array(
                    'experience' => $experience,
                    'images' => $images,
        ));
    }
    
    public function showFrontAction() {
        $em = $this->getDoctrine()->getManager();
        $experience = $em->getRepository('BestTripWeeGoBundle:Experience')->findAll();
        $images = array();
        foreach ($experience as $key => $entity) {
            $images[$key] = base64_encode(stream_get_contents($entity->getImage()));
        }
        return $this->render('BestTripWeeGoBundle:Front:showFront.html.twig', array(
                    'experience' => $experience,
                    'images' => $images,
        ));
    }
    
    public function afFrontAction($id) {
        $em = $this->getDoctrine()->getManager();
        $experience = $em->getRepository('BestTripWeeGoBundle:Experience')->findById($id);
        $recommandations = $em->getRepository('BestTripWeeGoBundle:RecommandationExperience')->findBy(array('idExperience' => $experience), array('id' => 'DESC'));
        ;

        $images = array();
        foreach ($experience as $key => $entity) {
            $images[$key] = base64_encode(stream_get_contents($entity->getImage()));
        }
        return $this->render('BestTripWeeGoBundle:Front:afFront.html.twig', array(
                    'experience' => $experience,
                    'images' => $images,
                    'recommandations' => $recommandations
        ));
    }

}
