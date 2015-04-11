<?php

namespace BestTrip\WeeGoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecommandationLieu
 *
 * @ORM\Table(name="recommandation_lieu", indexes={@ORM\Index(name="id", columns={"id", "id_lieu"}), @ORM\Index(name="id_2", columns={"id", "id_lieu"}), @ORM\Index(name="id_lieu", columns={"id_lieu"})})
 * @ORM\Entity
 */
class RecommandationLieu extends Recommandation {

    

    /**
     * @var \Lieu
     *
     * @ORM\ManyToOne(targetEntity="Lieu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_lieu", referencedColumnName="id")
     * })
     */
    private $idLieu;

    

    /**
     * Set idLieu
     *
     * @param \BestTrip\WeeGoBundle\Entity\Lieu $idLieu
     * @return RecommandationLieu
     */
    public function setIdLieu(\BestTrip\WeeGoBundle\Entity\Lieu $idLieu = null) {
        $this->idLieu = $idLieu;

        return $this;
    }

    /**
     * Get idLieu
     *
     * @return \BestTrip\WeeGoBundle\Entity\Lieu 
     */
    public function getIdLieu() {
        return $this->idLieu;
    }

}
