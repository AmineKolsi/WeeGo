<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExperienceRepository
 *
 * @author Aminovski
 */
namespace BestTrip\WeeGoBundle\Entity;
use \Doctrine\ORM\EntityRepository;

class ExperienceRepository extends EntityRepository{
    public function findByDatePublication($data){
        //var_dump($data);
        $query = $em->createQuery('SELECT count(exp.id) FROM Experience exp GROUP BY MONTH(exp.date_publication) having (YEAR(exp.date_publication)= :an)')
                    ->setParameter('an',$annee);
        //die('hello');
        
        $query = Doctrine_Query::create()
        ->select('u.id')
        ->from('Experience u')
        ->where('YEAR(date_publication)=?',$data['annee']);
  
        //->groupBy('u.id');
               
            
       echo('hello');

        return $query->getQuery()->getResult();
    }
}
