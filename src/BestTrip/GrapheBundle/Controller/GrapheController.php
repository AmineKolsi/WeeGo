<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GrapheController
 *
 * @author Aminovski
 */

namespace BestTrip\GrapheBundle\Controller;

use \Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Ob\HighchartsBundle\Highcharts\Highchart;
use \Zend\Json\Expr;
use \BestTrip\GrapheBundle\Form\RechercheParAnneeType;

class GrapheController extends Controller {

    public function chartLineAction() {

        $series = array(array("name" => "Nombre d'expériences publiées", "data" => array(1, 2, 3, 4, 5, 7)));

        $ob = new Highchart();
        $ob->chart->renderTo('linechart');
        $ob->title->text('Titre du graphique');
        $ob->xAxis->title(array('text' => "Titre axe horizontal"));

        $ob->yAxis->title(array('text' => "Titre axe vertical "));

        $ob->series($series);

        return $this->render('BestTripGrapheBundle:Graphe:LineChart.html.twig', array(
                    'chart' => $ob
        ));
    }

    public function chartHistogrammeAction() {
        
        
        $requete = $this->container->get('request');
        $annee = $requete->get('annee');
        //var_dump($requete);
        if ($requete->getMethod() == 'POST') {
            
            //$form->bind($request);
            
            if ($annee != "") {
                
                $em = $this->getDoctrine()->getManager();
                //$data = $this->getRequest()->request->get('formulaireRechercheParAnnee');
                $query = $em->createQuery("SELECT count(exp.id) as nbr, SUBSTRING(exp.datePublication,6,2) AS month FROM BestTripWeeGoBundle:Experience exp WHERE (SUBSTRING(exp.datePublication,1,4)= :an) group by month")
                        ->setParameter('an', $annee);

                $experiences = $query->getResult();
                
                $query2 = $em->createQuery("SELECT count(u.id) as nbr, SUBSTRING(u.dateInscrit,6,2) AS month FROM BestTripWeeGoBundle:FosUser u WHERE (SUBSTRING(u.dateInscrit,1,4)= :an) group by month")
                        ->setParameter('an', $annee);
                
                $users = $query2->getResult();

                $nbrExp = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
                $nbrUser = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

                $mois = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');

                foreach ($experiences as $e):

                    for ($i = 0; $i < 12; $i++) {
                        if ($mois[$i] == $e['month']) {
                            $nbrExp[$i] = intval($e['nbr']);
                        }
                    }

                endforeach;
                foreach ($users as $u):
                    for ($i = 0; $i < 12; $i++) {
                        if ($mois[$i] == $u['month']) {
                            $nbrUser[$i] = intval($u['nbr']);
                        }
                    }
                    
                endforeach;
                $series = array(
                    array(
                        'name' => 'Experiences',
                        'type' => 'column',
                        'color' => '#75c5c3',
                        'yAxis' => 1,
                        'data' => $nbrExp,
                    ),
                    array(
                        'name' => 'Temperature',
                        'type' => 'spline',
                        'color' => '#e0304a',
                        'data' => $nbrUser,
                    ),
                );
                $yData = array(
                    array(
                        'labels' => array(
                            'formatter' => new Expr('function () { return this.value + " inscrits" }'),
                            'style' => array('color' => '#e0304a')
                        ),
                        'title' => array(
                            'text' => 'Nouveaux inscrits',
                            'style' => array('color' => '#e0304a')
                        ),
                        'opposite' => true,
                    ),
                    array(
                        'labels' => array(
                            'formatter' => new Expr('function () { return this.value}'),
                            'style' => array('color' => '#75c5c3')
                        ),
                        'gridLineWidth' => 0,
                        'title' => array(
                            'text' => 'Expériences',
                            'style' => array('color' => '#4572A7')
                        ),
                    ),
                );
                $categories = array('Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aout', 'Sep', 'Oct', 'Nov', 'Déc');

                $ob = new Highchart();

                $ob->chart->renderTo('container'); // The #id of the div where to render the chart

                $ob->chart->type('column');

                $ob->title->text("Évolution des expériences et des nouveaux inscrits pour l'année ".$annee);

                $ob->xAxis->categories($categories);

                $ob->yAxis($yData);

                $ob->legend->enabled(false);

                $formatter = new Expr('function () {

            var unit = {

            "Expériences": "",

            "Nouveaux inscrits": "inscrits"

            }[this.series.name];

            return this.x + ": <b>" + this.y + "</b> " + unit;

            }');

                $ob->tooltip->formatter($formatter);

                $ob->series($series);

                return $this->render('BestTripGrapheBundle:Graphe:histogramme.html.twig', array(
                            'chart' => $ob
                ));
            }
        }
        return $this->render('BestTripGrapheBundle:Experiences:ListeExperiences.html.twig', array('experiences' => null));
    }

    public function rechercheAction() {
        $form = $this->createForm(new RechercheParAnneeType());
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {

            $form->bind($request);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $data = $this->getRequest()->request->get('formulaireRechercheParAnnee');
                $query = $em->createQuery("SELECT count(exp.id) as nbr, SUBSTRING(exp.datePublication,6,2) AS month FROM BestTripWeeGoBundle:Experience exp WHERE (SUBSTRING(exp.datePublication,1,4)= :an) group by month")
                        ->setParameter('an', $data['annee']);

                $experiences = $query->getResult();

                $nbrExp = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

                $mois = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');


                foreach ($experiences as $e):

                    for ($i = 0; $i < 12; $i++) {
                        if ($mois[$i] == $e['month']) {
                            $nbrExp[$i] = intval($e['nbr']);
                        }
                    }

                endforeach;






                return $this->render('BestTripGrapheBundle:Experiences:ListeExperiences.html.twig', array('form' => $form->createView()));
            }
        }

        return $this->render('BestTripGrapheBundle:Experiences:ListeExperiences.html.twig', array('form' => $form->createView()));
    }
public function lieuplusvisiteAction(){
        $ob=new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Les Pays les plus visite');
        $ob->plotOptions->pie(array(
            'allowPointSelect'=>true,
            'cursor'=>'pointer',
            'dataLabels'=>array('enabled'=>false),
            'showInLegend'=>true
        ));
         $em = $this->getDoctrine()->getManager();
         $query = $em->createQuery("SELECT count(p.nomPays) as cp,p.nomPays FROM BestTripWeeGoBundle:Experience exp,BestTripWeeGoBundle:Pays p,BestTripWeeGoBundle:Ville v,BestTripWeeGoBundle:Lieu l where exp.idLieu=l.id and l.idVille=v.idV and 
v.idPays=p.idP
group by p.nomPays");
         $pays = $query->getResult();
         
         $data=array();
         foreach ($pays as $p) {
             $donne=array($p['nomPays'],intval($p['cp']));
             array_push($data,$donne);
         };
        $ob->series(array(array('type'=>'pie','name'=>'Browser share','data'=>$data)));
        return $this->render('BestTripGrapheBundle:Graphe:lpv.html.twig',array('chart'=>$ob));
    }
}
