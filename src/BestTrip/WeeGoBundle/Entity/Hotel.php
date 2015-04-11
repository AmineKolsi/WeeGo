<?php

namespace BestTrip\WeeGoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hotel
 *
 * @ORM\Table(name="hotel")
 * @ORM\Entity
 */
class Hotel extends Lieu
{
    /**
     * @var string
     *
     * @ORM\Column(name="nbr_etoiles", type="text", length=65535, nullable=false)
     */
    private $nbrEtoiles;

    /**
     * @var string
     *
     * @ORM\Column(name="service", type="text", length=65535, nullable=false)
     */
    private $service;

    /**
     * @var string
     *
     * @ORM\Column(name="emplacement", type="text", length=65535, nullable=false)
     */
    private $emplacement;

    


    /**
     * Set nbrEtoiles
     *
     * @param string $nbrEtoiles
     * @return Hotel
     */
    public function setNbrEtoiles($nbrEtoiles)
    {
        $this->nbrEtoiles = $nbrEtoiles;

        return $this;
}

    /**
     * Get nbrEtoiles
     *
     * @return string 
     */
    public function getNbrEtoiles()
    {
        return $this->nbrEtoiles;
    }

    /**
     * Set service
     *
     * @param string $service
     * @return Hotel
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return string 
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set emplacement
     *
     * @param string $emplacement
     * @return Hotel
     */
    public function setEmplacement($emplacement)
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    /**
     * Get emplacement
     *
     * @return string 
     */
    public function getEmplacement()
    {
        return $this->emplacement;
    }

    
}
