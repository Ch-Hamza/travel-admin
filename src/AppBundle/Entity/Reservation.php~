<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservationRepository")
 */
class Reservation
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Trip")
     */
    private $trip;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_adultes", type="integer")
     */
    private $nbrAdultes;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_enfants", type="integer")
     */
    private $nbrEnfants;

    /**
     * @var bool
     *
     * @ORM\Column(name="statut", type="boolean")
     */
    private $statut;


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
     * Set email.
     *
     * @param string $email
     *
     * @return Reservation
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set nbrAdultes.
     *
     * @param int $nbrAdultes
     *
     * @return Reservation
     */
    public function setNbrAdultes($nbrAdultes)
    {
        $this->nbrAdultes = $nbrAdultes;

        return $this;
    }

    /**
     * Get nbrAdultes.
     *
     * @return int
     */
    public function getNbrAdultes()
    {
        return $this->nbrAdultes;
    }

    /**
     * Set nbrEnfants.
     *
     * @param int $nbrEnfants
     *
     * @return Reservation
     */
    public function setNbrEnfants($nbrEnfants)
    {
        $this->nbrEnfants = $nbrEnfants;

        return $this;
    }

    /**
     * Get nbrEnfants.
     *
     * @return int
     */
    public function getNbrEnfants()
    {
        return $this->nbrEnfants;
    }

    /**
     * Set statut.
     *
     * @param bool $statut
     *
     * @return Reservation
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut.
     *
     * @return bool
     */
    public function getStatut()
    {
        return $this->statut;
    }



    /**
     * Set trip.
     *
     * @param \AppBundle\Entity\Trip|null $trip
     *
     * @return Reservation
     */
    public function setTrip(\AppBundle\Entity\Trip $trip = null)
    {
        $this->trip = $trip;

        return $this;
    }

    /**
     * Get trip.
     *
     * @return \AppBundle\Entity\Trip|null
     */
    public function getTrip()
    {
        return $this->trip;
    }
}
