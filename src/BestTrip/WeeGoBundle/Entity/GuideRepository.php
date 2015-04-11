<?php
namespace BestTrip\WeeGoBundle\Entity;
use Doctrine\ORM\EntityRepository;
class GuideRepository extends EntityRepository{
            public function find1All($guide)
         {
      $query=$this->getEntityManager()->
                   createQuery("select count(c.id) as nombre"
                           . "  FROM BestTripWeeGoBundle:Guide g JOIN BestTripWeeGoBundle:Contribution c WITH g.idG=c.idGuide"
                           . " where g.idG=:idG group by g.idG")->setParameters(array('idG'=>$guide));;

      try {
          return $query->getSingleScalarResult();
      } catch (\Doctrine\ORM\NoResultException $e) {
          return null;
      }
         }
       
}
