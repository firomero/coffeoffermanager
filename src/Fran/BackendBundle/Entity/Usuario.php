<?php
/**
 * Created by PhpStorm.
 * User: firomero
 * Date: 02/04/2015
 * Time: 23:06
 */

namespace Fran\BackendBundle\Entity;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */

class Usuario extends BaseUser {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\OneToMany(targetEntity="Menu", mappedBy="usuario")
     */
    protected $menu;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct()
    {
        parent::__construct();

        $this->menu = new ArrayCollection();;
    }
}