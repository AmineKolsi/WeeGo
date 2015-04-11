<?php

namespace BestTrip\WeeGoBundle\Controller;

use \Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BestTrip\WeeGoBundle\Entity\RecommandationLieu;
use BestTrip\WeeGoBundle\Entity\Pays;
use BestTrip\WeeGoBundle\Entity\Ville;
use BestTrip\WeeGoBundle\Entity\Hotel;
use BestTrip\WeeGoBundle\Entity\Restaurant;
use BestTrip\WeeGoBundle\Form\HotelForm;
use BestTrip\WeeGoBundle\Form\RestaurantForm;
use Zend\Stdlib\DateTime;
use Symfony\Component\HttpFoundation\JsonResponse;

class LieuController extends Controller {

    public function rechercheAction($nom) {

        $l = new Lieu();

        $em = $this->getDoctrine()->getManager();
        $l = $em->getRepository('BestTripWeeGoBundle:Lieu')->findOneBy(array('nom' => $nom));

        $statut = $l->getStatut();
        $adresse = $l->getAdresse();
        $numtel = $l->getNumtel();
        $siteweb = $l->getSiteweb();
        $path = $l->getWebPath();
        $nom = $l->getNom();




        $response = new JsonResponse();
        return $response->setData(array("statut" => $statut, "adresse" => $adresse, "numtel" => $numtel, "siteweb" => $siteweb, "path" => $path, "nom" => $nom));
    }

    public function villeAction($nompays) {

        $pays = new Pays();
        $v = new Ville();
        $em = $this->getDoctrine()->getManager();
        $pays = $em->getRepository('BestTripWeeGoBundle:Pays')->findOneBy(array('nomPays' => $nompays));

        $x = $pays->getIdP();
        $v = $em->getRepository('BestTripWeeGoBundle:Ville')->findBy(array('idPays' => $x));
        $villes = array();
        foreach ($v as $ville) {
            $villes[] = $ville->getNomV();
        }


        $response = new JsonResponse();
        return $response->setData(array("ville" => $villes));
    }

    public function paysAction() {
        $em = $this->getDoctrine()->getManager();
        $pays = $em->getRepository('BestTripWeeGoBundle:Pays')->findAll();
        return $this->render('BestTripWeeGoBundle:Lieu:exemple.html.twig', array('pays' => $pays));
    }

    public function chercherLieuAction() {

        return $this->render('BestTripWeeGoBundle:Lieu:rechercheLieu.html.twig');
    }

    public function afficherAction() {
        $em = $this->getDoctrine()->getManager();
        $lieu = $em->getRepository('BestTripWeeGoBundle:Lieu')->findAll();
        return $this->render('BestTripWeeGoBundle:Lieu:afficherLieu.html.twig', array('lieu' => $lieu));
    }

    public function infoLieuAction($id, $statut) {


        $em = $this->getDoctrine()->getManager();
        if ($statut == "hotel") {
            $lieu = $em->getRepository('BestTripWeeGoBundle:Hotel')->findById($id);
            $lieu2 = new Hotel();
            $lieu2 = $em->getRepository('BestTripWeeGoBundle:Hotel')->findOneById($id);
            $x = $lieu2->getAdresse();
        } else {
            $lieu = $em->getRepository('BestTripWeeGoBundle:Restaurant')->findById($id);
        }

        $recommandations = $em->getRepository('BestTripWeeGoBundle:RecommandationLieu')->findBy(array('idLieu' => $lieu), array('id' => 'DESC'));
        ;

        $requete = $this->container->get('request');
        $idU = $requete->get('idU');
        $note = $requete->get('note');
        $texte = $requete->get('texteR');

        $recommandationL = new RecommandationLieu();
        $date = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));


        $lieu1 = $em->getRepository('BestTripWeeGoBundle:Lieu')->findOneById($id);
        $utilisateur = $em->getRepository('BestTripWeeGoBundle:Utilisateur')->findOneById($idU);
        $recommandationL->setIdLieu($lieu1);
        $recommandationL->setNote($note);
        $recommandationL->setTexte($texte);
        $recommandationL->setUtilisateur($utilisateur);
        $recommandationL->setDateRecommandation($date);


        if ($note != "" && $texte != "" && $idU != "") {
            $em->getRepository('BestTripWeeGoBundle:RecommandationLieu');
            $em->persist($recommandationL);
            $em->flush();
            if ($statut == "hotel") {
                return $this->render('BestTripWeeGoBundle:Lieu:afficherHotel.html.twig', array('lieu' => $lieu, 'recommandations' => $recommandations, 'x' => $x));
            } else {
                return $this->render('BestTripWeeGoBundle:Lieu:afficherRestaurant.html.twig', array('lieu' => $lieu, 'recommandations' => $recommandations));
            }
        }
        //var_dump($recommandations);

        if ($statut == "hotel") {
            return $this->render('BestTripWeeGoBundle:Lieu:afficherHotel.html.twig', array('lieu' => $lieu, 'recommandations' => $recommandations, 'x' => $x));
        } else {
            return $this->render('BestTripWeeGoBundle:Lieu:afficherRestaurant.html.twig', array('lieu' => $lieu, 'recommandations' => $recommandations));
        }
    }

    public function infoLieuAdminAction($id, $statut) {


        $em = $this->getDoctrine()->getManager();
        if ($statut == "hotel") {
            $lieu = $em->getRepository('BestTripWeeGoBundle:Hotel')->findById($id);
            $lieu2 = new Hotel();
            $lieu2 = $em->getRepository('BestTripWeeGoBundle:Hotel')->findOneById($id);
            $x = $lieu2->getAdresse();
        } else {
            $lieu = $em->getRepository('BestTripWeeGoBundle:Restaurant')->findById($id);
        }

        $recommandations = $em->getRepository('BestTripWeeGoBundle:RecommandationLieu')->findBy(array('idLieu' => $lieu), array('id' => 'DESC'));
        ;

        $requete = $this->container->get('request');
        $idU = $requete->get('idU');
        $note = $requete->get('note');
        $texte = $requete->get('texteR');

        $recommandationL = new RecommandationLieu();
        $date = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));


        $lieu1 = $em->getRepository('BestTripWeeGoBundle:Lieu')->findOneById($id);
        $utilisateur = $em->getRepository('BestTripWeeGoBundle:Utilisateur')->findOneById($idU);
        $recommandationL->setIdLieu($lieu1);
        $recommandationL->setNote($note);
        $recommandationL->setTexte($texte);
        $recommandationL->setUtilisateur($utilisateur);
        $recommandationL->setDateRecommandation($date);


        if ($note != "" && $texte != "" && $idU != "") {
            $em->getRepository('BestTripWeeGoBundle:RecommandationLieu');
            $em->persist($recommandationL);
            $em->flush();
            if ($statut == "hotel") {
                return $this->render('BestTripWeeGoBundle:Lieu:afficherHotelAdmin.html.twig', array('lieu' => $lieu, 'recommandations' => $recommandations, 'x' => $x));
            } else {
                return $this->render('BestTripWeeGoBundle:Lieu:afficherRestaurantAdmin.html.twig', array('lieu' => $lieu, 'recommandations' => $recommandations));
            }
        }
        //var_dump($recommandations);

        if ($statut == "hotel") {
            return $this->render('BestTripWeeGoBundle:Lieu:afficherHotelAdmin.html.twig', array('lieu' => $lieu, 'recommandations' => $recommandations, 'x' => $x));
        } else {
            return $this->render('BestTripWeeGoBundle:Lieu:afficherRestaurantAdmin.html.twig', array('lieu' => $lieu, 'recommandations' => $recommandations));
        }
    }

    public function afficherLAAction() {
        $em = $this->getDoctrine()->getManager();
        $lieu = $em->getRepository('BestTripWeeGoBundle:Lieu')->findAll();
        return $this->render('BestTripWeeGoBundle:Lieu:afficherLA.html.twig', array('lieu' => $lieu));
    }

    public function supprimerLieuAction($id) {



        $em = $this->getDoctrine()->getManager();
        $lieu = $em->getRepository('BestTripWeeGoBundle:Lieu')->findOneById($id);

        $em->remove($lieu);

        $em->flush();
        return $this->redirect($this->generateUrl('best_trip_wee_go_afficherLA'));
    }

    public function ajoutHotelAction() {

        $h = new Hotel();
        $f = new HotelForm();
        $form = $this->createForm($f, $h);
        $h->setStatut("hotel");
        $request = $this->get('request');
        $form->handleRequest($request);
        $x = $request->get('ville');
        $em = $this->getDoctrine()->getManager();
        if ($x != "") {
            $ville = new Ville();

            $ville = $em->getRepository('BestTripWeeGoBundle:Ville')->findOneBy(array('nomV' => $x));
            $idR = $ville->getIdV();


            $h->setIdVille($ville);
        }


        $em = $this->getDoctrine()->getManager();

        $pays = $em->getRepository('BestTripWeeGoBundle:Pays')->findAll();



        if ($request->getMethod() == 'POST') {

            $em = $this->getDoctrine()->getManager();
            $em->getRepository('BestTripWeeGoBundle:Hotel');
            $h->upload();
            $em->persist($h);
            $em->flush();

            return $this->redirect($this->generateUrl('best_trip_wee_go_afficher'));
        }

        return $this->render('BestTripWeeGoBundle:Lieu:ajoutHotel.html.twig', array('form' => $form->createView(), 'pays' => $pays));
    }

    public function ajoutRestaurantAction() {

        $r = new Restaurant();
        $f = new RestaurantForm();
        $form = $this->createForm($f, $r);
        $r->setStatut("restaurant");
        $request = $this->get('request');
        $form->handleRequest($request);


        $x = $request->get('ville');
        $em = $this->getDoctrine()->getManager();
        if ($x != "") {
            $ville = new Ville();

            $ville = $em->getRepository('BestTripWeeGoBundle:Ville')->findOneBy(array('nomV' => $x));
            $idR = $ville->getIdV();


            $r->setIdVille($ville);
        }




        $pays = $em->getRepository('BestTripWeeGoBundle:Pays')->findAll();

        if ($request->getMethod() == 'POST') {

            $em = $this->getDoctrine()->getManager();
            $em->getRepository('BestTripWeeGoBundle:Restaurant');
            $r->upload();

            $em->persist($r);
            $em->flush();

            return $this->redirect($this->generateUrl('best_trip_wee_go_afficher'));
        }

        return $this->render('BestTripWeeGoBundle:Lieu:ajoutRestaurant.html.twig', array('form' => $form->createView(), 'pays' => $pays));
    }

    public function modifierAction($id, $statut) {
        $hotel = new Hotel();
        $em = $this->getDoctrine()->getManager();
        $pays = $em->getRepository('BestTripWeeGoBundle:Pays')->findAll();
        if ($statut == "restaurant") {

            $restaurant = new Restaurant();
            $em = $this->getDoctrine()->getManager();
            $restaurant = $em->getRepository('BestTripWeeGoBundle:Restaurant')->find($id);
            $f = new RestaurantForm();
            $form = $this->createForm($f, $restaurant);
            $request = $this->get('request');
            $form->handleRequest($request);
            $x = $request->get('ville');
            if ($x != "") {
                $ville = new Ville();

                $ville = $em->getRepository('BestTripWeeGoBundle:Ville')->findOneBy(array('nomV' => $x));
                $idR = $ville->getIdV();


                $restaurant->setIdVille($ville);
            }

            if ($request->getMethod() == 'POST') {

                $em = $this->getDoctrine()->getManager();
                $em->getRepository('BestTripWeeGoBundle:Restaurant');

                $restaurant->upload();
                $em->persist($restaurant);
                $em->flush();

                return $this->redirect($this->generateUrl('best_trip_wee_go_afficherLA'));
            } return $this->render('BestTripWeeGoBundle:Lieu:modifierRestaurant.html.twig', array('form' => $form->createView(), 'restaurant' => $restaurant, 'pays' => $pays));
        }

        $em = $this->getDoctrine()->getManager();
        $hotel = $em->getRepository('BestTripWeeGoBundle:Hotel')->find($id);
        $f = new HotelForm();
        $form = $this->createForm($f, $hotel);
        $request = $this->get('request');
        $form->handleRequest($request);
        $x = $request->get('ville');

        if ($x != "") {
            $ville = new Ville();

            $ville = $em->getRepository('BestTripWeeGoBundle:Ville')->findOneBy(array('nomV' => $x));
            $idR = $ville->getIdV();


            $hotel->setIdVille($ville);
        }

        if ($request->getMethod() == 'POST') {

            $em = $this->getDoctrine()->getManager();
            $em->getRepository('BestTripWeeGoBundle:Hotel');
            $hotel->upload();
            $em->persist($hotel);
            $em->flush();

            return $this->redirect($this->generateUrl('best_trip_wee_go_afficherLA'));
        } return $this->render('BestTripWeeGoBundle:Lieu:modifierHotel.html.twig', array('form' => $form->createView(), 'hotel' => $hotel, 'pays' => $pays));
    }
    
    public function afficherLieuFrontAction() {
        $em = $this->getDoctrine()->getManager();
        $lieu = $em->getRepository('BestTripWeeGoBundle:Lieu')->findAll();
        return $this->render('BestTripWeeGoBundle:Front:afficherLieuFront.html.twig', array('lieu' => $lieu));
    }
    
    public function infoLieuFrontAction($id, $statut) {


        $em = $this->getDoctrine()->getManager();
        if ($statut == "hotel") {
            $lieu = $em->getRepository('BestTripWeeGoBundle:Hotel')->findById($id);
            $lieu2 = new Hotel();
            $lieu2 = $em->getRepository('BestTripWeeGoBundle:Hotel')->findOneById($id);
            $x = $lieu2->getAdresse();
        } else {
            $lieu = $em->getRepository('BestTripWeeGoBundle:Restaurant')->findById($id);
        }

        $recommandations = $em->getRepository('BestTripWeeGoBundle:RecommandationLieu')->findBy(array('idLieu' => $lieu), array('id' => 'DESC'));
        ;

        $requete = $this->container->get('request');
        $idU = $requete->get('idU');
        $note = $requete->get('note');
        $texte = $requete->get('texteR');

        $recommandationL = new RecommandationLieu();
        $date = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));


        $lieu1 = $em->getRepository('BestTripWeeGoBundle:Lieu')->findOneById($id);
        $utilisateur = $em->getRepository('BestTripWeeGoBundle:Utilisateur')->findOneById($idU);
        $recommandationL->setIdLieu($lieu1);
        $recommandationL->setNote($note);
        $recommandationL->setTexte($texte);
        $recommandationL->setUtilisateur($utilisateur);
        $recommandationL->setDateRecommandation($date);


        if ($note != "" && $texte != "" && $idU != "") {
            $em->getRepository('BestTripWeeGoBundle:RecommandationLieu');
            $em->persist($recommandationL);
            $em->flush();
            if ($statut == "hotel") {
                return $this->render('BestTripWeeGoBundle:Front:afficherHotelFront.html.twig', array('lieu' => $lieu, 'recommandations' => $recommandations, 'x' => $x));
            } else {
                return $this->render('BestTripWeeGoBundle:Front:afficherRestaurantFront.html.twig', array('lieu' => $lieu, 'recommandations' => $recommandations));
            }
        }
        //var_dump($recommandations);

        if ($statut == "hotel") {
            return $this->render('BestTripWeeGoBundle:Front:afficherHotelFront.html.twig', array('lieu' => $lieu, 'recommandations' => $recommandations, 'x' => $x));
        } else {
            return $this->render('BestTripWeeGoBundle:Front:afficherRestaurantFront.html.twig', array('lieu' => $lieu, 'recommandations' => $recommandations));
        }
    }

}
