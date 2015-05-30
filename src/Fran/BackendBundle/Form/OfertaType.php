<?php

namespace Fran\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OfertaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre',null,array('attr'=>array('class'=>'ofertaName')))
            ->add('descripcion','textarea',array('attr'=>array('class'=>'ofertaDescripcion')))
            ->add('imageFile', 'vich_file', array(
                'required'      => false,
                 'label' => 'Foto'

            ))
            ->add('precio', null, array('attr'=>array('class'=>'ofertaPrecio')))
            ->add('disponible')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fran\BackendBundle\Entity\Oferta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fran_backendbundle_oferta';
    }
}
