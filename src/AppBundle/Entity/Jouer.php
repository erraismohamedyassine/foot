<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jouer
 *
 * @ORM\Table(name="jouer", indexes={@ORM\Index(name="FK_jouerPlayer", columns={"id_pl"}), @ORM\Index(name="FK_jouerEquipe", columns={"id_eq"})})
 * @ORM\Entity
 */
class Jouer
{
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
     * @var \AppBundle\Entity\Player
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Player")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pl", referencedColumnName="id")
     * })
     */
    private $idPl;

    /**
     * @var \AppBundle\Entity\Equipes
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Equipes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_eq", referencedColumnName="id")
     * })
     */
    private $idEq;

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
     * @return Player
     */
    public function getIdPl()
    {
        return $this->idPl;
    }

    /**
     * @param Player $idPl
     */
    public function setIdPl($idPl)
    {
        $this->idPl = $idPl;
    }

    /**
     * @return Equipes
     */
    public function getIdEq()
    {
        return $this->idEq;
    }

    /**
     * @param Equipes $idEq
     */
    public function setIdEq($idEq)
    {
        $this->idEq = $idEq;
    }


}

