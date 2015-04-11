<?php

namespace BestTrip\WeeGoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Restaurant
 *
 * @ORM\Table(name="restaurant", indexes={@ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Restaurant extends Lieu
{
    /**
     * @var string
     *
     * @ORM\Column(name="specialite", type="text", length=65535, nullable=false)
     */
    private $specialite;

    /**
     * @var string
     *
     * @ORM\Column(name="reservation", type="text", length=65535, nullable=false)
     */
    private $reservation;

    /**
     * @var string
     *
     * @ORM\Column(name="j_repos", type="text", length=65535, nullable=false)
     */
    private $jRepos;

    


    /**
     * Set specialite
     *
     * @param string $specialite
     * @return Restaurant
     */
    public function setSpecialite($specialite)
    {
        $this->specialite = $specialite;

        return $this;
}

    /**
     * Get specialite
     *
     * @return string 
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }

    /**
     * Set reservation
     *
     * @param string $reservation
     * @return Restaurant
     */
    public function setReservation($reservation)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return string 
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * Set jRepos
     *
     * @param string $jRepos
     * @return Restaurant
     */
    public function setJRepos($jRepos)
    {
        $this->jRepos = $jRepos;

        return $this;
    }

    /**
     * Get jRepos
     *
     * @return string 
     */
    public function getJRepos()
    {
        return $this->jRepos;
    }

    
}
