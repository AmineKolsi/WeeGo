<?php

namespace BestTrip\WeeGoBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Guide
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="guide", indexes={@ORM\Index(name="id_administrateur", columns={"id_administrateur"}), @ORM\Index(name="id_pays", columns={"id_pays"})})
 * @ORM\Entity(repositoryClass="BestTrip\WeeGoBundle\Entity\GuideRepository")
 */
class Guide
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_g", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idG;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=50, nullable=false)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="date", nullable=false)
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modification", type="date", nullable=false)
     */
    private $dateModification;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text", nullable=false)
     */
    private $texte;

    /**
     * @var \Administrateur
     *
     * @ORM\ManyToOne(targetEntity="Administrateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_administrateur", referencedColumnName="id")
     * })
     */
    private $idAdministrateur;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;
    /**
     * 
     * @Assert\File(maxSize="6000000")
     */
    public $file;

    /**
     * Get idG
     *
     * @return integer 
     */
    public function getIdG()
    {
        return $this->idG;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Guide
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Guide
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateModification
     *
     * @param \DateTime $dateModification
     * @return Guide
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * Get dateModification
     *
     * @return \DateTime 
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * Set texte
     *
     * @param string $texte
     * @return Guide
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
     * Set idAdministrateur
     *
     * @param \BestTrip\WeeGoBundle\Entity\Administrateur $idAdministrateur
     * @return Guide
     */
    public function setIdAdministrateur(\BestTrip\WeeGoBundle\Entity\Administrateur $idAdministrateur = null)
    {
        $this->idAdministrateur = $idAdministrateur;

        return $this;
    }

    /**
     * Get idAdministrateur
     *
     * @return \BestTrip\WeeGoBundle\Entity\Administrateur 
     */
    public function getIdAdministrateur()
    {
        return $this->idAdministrateur;
    }

    /**
     * Set idPays
     *
     * @param \BestTrip\WeeGoBundle\Entity\Pays $idPays
     * @return Guide
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
   
    /**
     * Set image
     *
     * @param string $image
     * @return Guide
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
     public function getAbsolutePath()
    {
        return null === $this->image ? null : $this->getUploadRootDir().'/'.$this->image;
    }

    public function getWebPath()
    {
        return null === $this->image ? null : $this->getUploadDir().'/'.$this->image;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'upload';
    }
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // faites ce que vous voulez pour générer un nom unique
            $this->image =$this->file->getClientOriginalName();
        }
    }
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        // s'il y a une erreur lors du déplacement du fichier, une exception
        // va automatiquement être lancée par la méthode move(). Cela va empêcher
        // proprement l'entité d'être persistée dans la base de données si
        // erreur il y a
        $this->file->move($this->getUploadRootDir(), $this->image);

        unset($this->file);
    }
     /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }
    public function __toString() {
       return $this->idPays; 
    }

    
}
