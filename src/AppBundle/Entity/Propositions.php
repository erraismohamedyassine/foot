<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Propositions
 *
 * @ORM\Table(name="propositions", indexes={@ORM\Index(name="id_p", columns={"id_player"}), @ORM\Index(name="id_a", columns={"id_acheteur"})})
 * @ORM\Entity
 */
class Propositions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="proposition_prix", type="integer", nullable=false)
     */
    private $propositionPrix;

    /**
     * @var string
     *
     * @ORM\Column(name="period", type="string", length=15, nullable=false)
     */
    private $period;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Acheteur
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Acheteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_acheteur", referencedColumnName="id")
     * })
     */
    private $idAcheteur;

    /**
     * @var \AppBundle\Entity\Player
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Player")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_player", referencedColumnName="id")
     * })
     */
    private $idPlayer;

    /**
     * @return int
     */
    public function getPropositionPrix()
    {
        return $this->propositionPrix;
    }

    /**
     * @param int $propositionPrix
     */
    public function setPropositionPrix($propositionPrix)
    {
        $this->propositionPrix = $propositionPrix;
    }

    /**
     * @return string
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param string $period
     */
    public function setPeriod($period)
    {
        $this->period = $period;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Acheteur
     */
    public function getIdAcheteur()
    {
        return $this->idAcheteur;
    }

    /**
     * @param Acheteur $idAcheteur
     */
    public function setIdAcheteur($idAcheteur)
    {
        $this->idAcheteur = $idAcheteur;
    }

    /**
     * @return Player
     */
    public function getIdPlayer()
    {
        return $this->idPlayer;
    }

    /**
     * @param Player $idPlayer
     */
    public function setIdPlayer($idPlayer)
    {
        $this->idPlayer = $idPlayer;
    }


}

