<?php

namespace BestTrip\WeeGoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pays
 *
 * @ORM\Table(name="pays")
 * @ORM\Entity
 */
class Pays
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_p", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idP;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_pays", type="string", length=50, nullable=false)
     */
    private $nomPays;

    /**
     * @var string
     *
     * @ORM\Column(name="continent", type="string", length=50, nullable=false)
     */
    private $continent;

    /**
     * @var string
     *
     * @ORM\Column(name="capitale", type="string", length=20, nullable=false)
     */
    private $capitale;

    /**
     * @var string
     *
     * @ORM\Column(name="langue", type="string", length=15, nullable=false)
     */
    private $langue;

    /**
     * @var string
     *
     * @ORM\Column(name="monnaie", type="string", length=10, nullable=false)
     */
    private $monnaie;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_habitant", type="integer", nullable=false)
     */
    private $nbHabitant;



    /**
     * Get idP
     *
     * @return integer 
     */
    public function getIdP()
    {
        return $this->idP;
    }

    /**
     * Set nomPays
     *
     * @param string $nomPays
     * @return Pays
     */
    public function setNomPays($nomPays)
    {
        $this->nomPays = $nomPays;

        return $this;
    }

    /**
     * Get nomPays
     *
     * @return string 
     */
    public function getNomPays()
    {
        return $this->nomPays;
    }

    /**
     * Set continent
     *
     * @param string $continent
     * @return Pays
     */
    public function setContinent($continent)
    {
        $this->continent = $continent;

        return $this;
    }

    /**
     * Get continent
     *
     * @return string 
     */
    public function getContinent()
    {
        return $this->continent;
    }

    /**
     * Set capitale
     *
     * @param string $capitale
     * @return Pays
     */
    public function setCapitale($capitale)
    {
        $this->capitale = $capitale;

        return $this;
    }

    /**
     * Get capitale
     *
     * @return string 
     */
    public function getCapitale()
    {
        return $this->capitale;
    }

    /**
     * Set langue
     *
     * @param string $langue
     * @return Pays
     */
    public function setLangue($langue)
    {
        $this->langue = $langue;

        return $this;
    }

    /**
     * Get langue
     *
     * @return string 
     */
    public function getLangue()
    {
        return $this->langue;
    }

    /**
     * Set monnaie
     *
     * @param string $monnaie
     * @return Pays
     */
    public function setMonnaie($monnaie)
    {
        $this->monnaie = $monnaie;

        return $this;
    }

    /**
     * Get monnaie
     *
     * @return string 
     */
    public function getMonnaie()
    {
        return $this->monnaie;
    }

    /**
     * Set nbHabitant
     *
     * @param integer $nbHabitant
     * @return Pays
     */
    public function setNbHabitant($nbHabitant)
    {
        $this->nbHabitant = $nbHabitant;

        return $this;
    }

    /**
     * Get nbHabitant
     *
     * @return integer 
     */
    public function getNbHabitant()
    {
        return $this->nbHabitant;
    }
    public function __toString() {
        return $this->nomPays;
    }

}
