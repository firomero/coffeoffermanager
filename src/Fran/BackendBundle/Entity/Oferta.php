<?php

namespace Fran\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Oferta
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Oferta
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
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255)
     */
    private $imagen;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="ofertas")
     * @ORM\JoinColumn(name="menu", referencedColumnName="id")
     */
    private $menu;

    /**
     * @return int
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @param int $menu
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Oferta
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return Oferta
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    
        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }
}