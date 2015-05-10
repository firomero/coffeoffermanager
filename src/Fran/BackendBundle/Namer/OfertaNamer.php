<?php
/**
 * Created by PhpStorm.
 * User: firomero
 * Date: 09/05/2015
 * Time: 23:22
 */

namespace Fran\BackendBundle\Namer;


use Fran\BackendBundle\Entity\Oferta;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\NamerInterface;

class OfertaNamer implements  NamerInterface{

    /**
     * Creates a name for the file being uploaded.
     *
     * @param object $object The object the upload is attached to.
     * @param PropertyMapping $mapping The mapping to use to manipulate the given object.
     *
     * @return string The file name.
     */
    public function name($object, PropertyMapping $mapping)
    {
       /**
        * @var Oferta $object
        * @var UploadedFile $filer
       */
        $filer = $object->getImageFile();
        return 'image'.date('YmdHis').'.'.$filer->getClientOriginalExtension();
    }
}