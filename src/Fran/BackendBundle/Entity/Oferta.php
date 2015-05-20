<?php

namespace Fran\BackendBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Oferta
 *
 * @ORM\Table()
 * @ORM\Entity
 *  @Vich\Uploadable
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
     * @ORM\Column(name="nombre", type="string", length=255)
     * @Assert\Regex(pattern="/[A-Za-z0-9]/", groups={"textos"})
     * @Assert\Length( min =3 ,groups={"textos"})
     * @Assert\NotBlank(message = "Por favor, escriba el nombre" ,groups={"textos"})
     */
    private $nombre;

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

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
     * Owning Side
     *@var integer
     * @ORM\ManyToMany(targetEntity="Menu", inversedBy="ofertas")
     * @ORM\JoinTable(name="menu_oferta",
     *      joinColumns={@ORM\JoinColumn(name="oferta_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="menu_id", referencedColumnName="id")}
     *      )
     */
    private $menu;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="imageFile", fileNameProperty="imagen")
     *
     * @var File $imageFile
     */
    protected $imageFile;


    /**
     * @var float
     * @ORM\Column(name="precio", type="float")
     * @Assert\NotBlank(message = "Por favor, escriba el nombre")
     * */
    protected $precio;

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
     *resumes de id
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

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
    }

    /**
     * Devuelve el fichero
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($value)
    {
        $this->precio = $value;
        return $this;
    }

    public function __toString()
    {
        return $this->nombre;
    }

    public function Normalized()
    {
        return array(
            $this->getId(),
            $this->getNombre(),
            $this->getDescripcion(),
            $this->getImagen(),
            $this->precio
        );
    }

}