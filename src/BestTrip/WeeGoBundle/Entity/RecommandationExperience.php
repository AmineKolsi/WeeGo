<?php

namespace BestTrip\WeeGoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecommandationExperience
 *
 * @ORM\Table(name="recommandation_experience", indexes={@ORM\Index(name="id_experience", columns={"id_experience"})})
 * @ORM\Entity
 */
class RecommandationExperience extends Recommandation {

    /**
     * @var \Experience
     *
     * @ORM\ManyToOne(targetEntity="Experience")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_experience", referencedColumnName="id")
     * })
     */
    private $idExperience;

    /**
     * Set idExperience
     *
     * @param \BestTrip\WeeGoBundle\Entity\Experience $idExperience
     * @return RecommandationExperience
     */
    public function setIdExperience(\BestTrip\WeeGoBundle\Entity\Experience $idExperience = null) {
        $this->idExperience = $idExperience;

        return $this;
    }

    /**
     * Get idExperience
     *
     * @return \BestTrip\WeeGoBundle\Entity\Experience 
     */
    public function getIdExperience() {
        return $this->idExperience;
    }

    

}
