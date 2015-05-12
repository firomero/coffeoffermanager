<?php

namespace Fran\BackendBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Menu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var integer
     *
    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="menu")
     * @ORM\JoinColumn(name="usuario", referencedColumnName="id")
     */
    private $usuario;

    /**
     * Inverse Side
     *
     * @ORM\ManyToMany(targetEntity="Oferta", mappedBy="menu")
     */
    protected $ofertas;

    public function __construct()
    {


        $this->ofertas = new ArrayCollection();;
    }


    /**
     * @return int
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param int $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }


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
     * Set nombre
     *
     * @param string $nombre
     * @return Menu
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    public function getOfertas()
    {
        return $this->ofertas;
    }

    public function setOfertas( ArrayCollection $ofertas)
    {
        $this->ofertas = $ofertas;
        return $this;
    }

    public function addOfertas(Oferta $oferta)
    {
        $this->ofertas->add($oferta);
    }

    public function removeOferta(Oferta $oferta)
    {
        $this->ofertas->remove($oferta->getId());
        return $this;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}