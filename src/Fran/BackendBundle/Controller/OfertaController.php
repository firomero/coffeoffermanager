<?php

namespace Fran\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Fran\BackendBundle\Entity\Oferta;
use Fran\BackendBundle\Form\OfertaType;

/**
 * Oferta controller.
 *
 */
class OfertaController extends Controller
{

    /**
     * Lists all Oferta entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Oferta();
        $form   = $this->createCreateForm($entity);

        $entities = $em->getRepository('BackendBundle:Oferta')->findAll();

        return $this->render('BackendBundle:Oferta:index.html.twig', array(
            'entities' => $entities,
            'form'=>$form->createView()
        ));
    }
    /**
     * Creates a new Oferta entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Oferta();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('oferta'));
        }

        return $this->render('BackendBundle:Oferta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Oferta entity.
     *
     * @param Oferta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Oferta $entity)
    {
        $form = $this->createForm(new OfertaType(), $entity, array(
            'action' => $this->generateUrl('oferta_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Oferta entity.
     *
     */
    public function newAction()
    {
        $entity = new Oferta();
        $form   = $this->createCreateForm($entity);

        return $this->render('BackendBundle:Oferta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Oferta entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Oferta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Oferta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Oferta:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Oferta entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Oferta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Oferta entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Oferta:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Oferta entity.
    *
    * @param Oferta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Oferta $entity)
    {
        $form = $this->createForm(new OfertaType(), $entity, array(
            'action' => $this->generateUrl('oferta_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Oferta entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Oferta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Oferta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('oferta_edit', array('id' => $id)));
        }

        return $this->render('BackendBundle:Oferta:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Oferta entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackendBundle:Oferta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Oferta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('oferta'));
    }

    /**
     * Creates a form to delete a Oferta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('oferta_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /*AJAX REQUEST*/
    public function addOfertaAction(Request $request)
    {
        $ofertaName = $request->get('ofertaName');
        $ofertaDescripcion = $request->get('ofertaDescripcion');
//        $ofertaImage = $request->ge
        $ofertaPrecio = $request->get('ofertaPrecio');

        try{
            if (!is_null($ofertaName)) {
                $oferta = new Oferta();
                $oferta->setNombre($ofertaName);
                $oferta->setDescripcion($ofertaDescripcion);
                $validator = $this->get('validator');
                $errors = $validator->validate($oferta);
                if (count($errors)>0) {
                    return new Response(json_encode(array('msg'=>'Empty Parameter')), 400);
                }
                $em = $this->get('doctrine')->getManager();
                $em->persist($ofertaName);
                $em->flush();
                return new Response(json_encode(array('msg'=>'OK'),200));

            }
            else{
                return new Response(json_encode(array('msg'=>'Empty Parameter')), 400);
            }

        }
        catch(\Exception $error)
        {
            return new Response(json_encode(array('msg'=>$error->getMessage())), 500);
        }
    }

    public function editMenuAction(Request $request)
    {
        $menuId = $request->get('id');
        $menuName = $request->get('ofertaName');

        try{
            if (!is_null($menuId)&&!is_null($menuName)) {
                $em = $this->get('doctrine')->getManager();
                $menu = $em->getRepository('BackendBundle:Oferta')->find($menuId);
                $menu->setNombre($menuName);
                $validator = $this->get('validator');
                $errors = $validator->validate($menu);
                if (count($errors)>0) {
                    return new Response(json_encode(array('msg'=>'Empty Parameter')), 400);
                }

                $em->persist($menu);
                $em->flush();
                return new Response(json_encode(array('msg'=>'OK'),206));

            }
            else{
                return new Response(json_encode(array('msg'=>'Empty Parameter')), 400);
            }

        }
        catch(\Exception $error)
        {
            return new Response(json_encode(array('msg'=>$error->getMessage())), 500);
        }
    }

    public function ofertasAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('BackendBundle:Oferta')->findAll();

    }
}
