<?php

namespace BestTrip\WeeGoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recommandation
 *
 * @ORM\Table(name="recommandation")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"lieu" = "RecommandationLieu", "experience" = "RecommandationExperience"})
 */
abstract class Recommandation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text", length=65535, nullable=false)
     */
    private $texte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_recommandation", type="date", nullable=false)
     */
    private $dateRecommandation;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * 
     */
    private $utilisateur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="note", type="integer", nullable=false)
     */
    private $note;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set texte
     *
     * @param string $texte
     * @return Recommandation
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string 
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set dateRecommandation
     *
     * @param \DateTime $dateRecommandation
     * @return Recommandation
     */
    public function setDateRecommandation($dateRecommandation)
    {
        $this->dateRecommandation = $dateRecommandation;

        return $this;
    }

    /**
     * Get dateRecommandation
     *
     * @return \DateTime 
     */
    public function getDateRecommandation()
    {
        return $this->dateRecommandation;
    }

    /**
     * Set idUtilisateur
     *
     * @param \BestTrip\WeeGoBundle\Entity\FosUser $idUtilisateur
     * @return Recommandation
     */
    public function setUtilisateur(\BestTrip\WeeGoBundle\Entity\FosUser $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get idUtilisateur
     *
     * @return \BestTrip\WeeGoBundle\Entity\FosUser 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    

    /**
     * Set note
     *
     * @param integer $note
     * @return Recommandation
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer 
     */
    public function getNote()
    {
        return $this->note;
    }
}
