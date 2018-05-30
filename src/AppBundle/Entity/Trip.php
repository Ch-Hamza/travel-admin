<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Trip
 *
 * @ORM\Table(name="trips")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TripRepository")
 * @Vich\Uploadable
 */
class Trip
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="cree_par", type="string", length=255)
     */
    private $creePar;

    /**
     *
     * @ORM\Column(name="date_depart", type="date")
     */
    private $dateDepart;

    /**
     *
     * @ORM\Column(name="date_retour", type="date")
     */
    private $dateRetour;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_personne", type="integer")
     */
    private $nbrPersonne;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_reservation", type="integer", nullable=true)
     */
    private $nbrReservation;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="user_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param File $imageFile
     */
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="string", length=255)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     *
     * @ORM\Column(name="statut", type="boolean")
     */
    private $statut;

    /**
     * @var bool
     *
     * @ORM\Column(name="featured", type="boolean")
     */
    private $featured;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Reservation", mappedBy="trip")
     */
    private $reservations;

    public function __construct()
    {
        $this->reservations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getReservations()
    {
        return $this->reservations;
    }

    /**
     * @param mixed $reservations
     */
    public function setReservations($reservations)
    {
        $this->reservations = $reservations;
    }



    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getCreePar()
    {
        return $this->creePar;
    }

    /**
     * @param string $creePar
     */
    public function setCreePar($creePar)
    {
        $this->creePar = $creePar;
    }

    /**
     * @return mixed
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * @param mixed $dateDepart
     */
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;
    }

    /**
     * @return mixed
     */
    public function getDateRetour()
    {
        return $this->dateRetour;
    }

    /**
     * @param mixed $dateRetour
     */
    public function setDateRetour($dateRetour)
    {
        $this->dateRetour = $dateRetour;
    }

    /**
     * @return int
     */
    public function getNbrPersonne()
    {
        return $this->nbrPersonne;
    }

    /**
     * @param int $nbrPersonne
     */
    public function setNbrPersonne($nbrPersonne)
    {
        $this->nbrPersonne = $nbrPersonne;
    }

    /**
     * @return int
     */
    public function getNbrReservation()
    {
        return $this->nbrReservation;
    }

    /**
     * @param int $nbrReservation
     */
    public function setNbrReservation($nbrReservation)
    {
        $this->nbrReservation = $nbrReservation;
    }

    /**
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param string $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param string $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param mixed $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return bool
     */
    public function isFeatured()
    {
        return $this->featured;
    }

    /**
     * @param bool $featured
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $userId
     */
    public function setUser($user)
    {
        $this->user = $user;
    }



    /**
     * Get featured.
     *
     * @return bool
     */
    public function getFeatured()
    {
        return $this->featured;
    }
}
