<?php

namespace BestTrip\WeeGoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ville
 *
 * @ORM\Table(name="ville", indexes={@ORM\Index(name="id_pays", columns={"id_pays"})})
 * @ORM\Entity
 */
class Ville
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_v", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idV;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_v", type="string", length=50, nullable=false)
     */
    private $nomV;

    /**
     * @var \Pays
     *
     * @ORM\ManyToOne(targetEntity="Pays")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pays", referencedColumnName="id_p")
     * })
     */
    private $idPays;



    /**
     * Get idV
     *
     * @return integer 
     */
    public function getIdV()
    {
        return $this->idV;
    }

    /**
     * Set nomV
     *
     * @param string $nomV
     * @return Ville
     */
    public function setNomV($nomV)
    {
        $this->nomV = $nomV;

        return $this;
    }

    /**
     * Get nomV
     *
     * @return string 
     */
    public function getNomV()
    {
        return $this->nomV;
    }

    /**
     * Set idPays
     *
     * @param \BestTrip\WeeGoBundle\Entity\Pays $idPays
     * @return Ville
     */
    public function setIdPays(\BestTrip\WeeGoBundle\Entity\Pays $idPays = null)
    {
        $this->idPays = $idPays;

        return $this;
    }

    /**
     * Get idPays
     *
     * @return \BestTrip\WeeGoBundle\Entity\Pays 
     */
    public function getIdPays()
    {
        return $this->idPays;
    }
    public function __toString() {
        return $this->nomV;
    }
}
