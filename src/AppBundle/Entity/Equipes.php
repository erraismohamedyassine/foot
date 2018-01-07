<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipes
 *
 * @ORM\Table(name="equipes", indexes={@ORM\Index(name="id_ach", columns={"id_acheteur"})})
 * @ORM\Entity
 */
class Equipes
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=15, nullable=false)
     */
    private $nom;

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
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
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


}

