<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ecommerce\EcommerceBundle\Entity\Garanties;
use Ecommerce\EcommerceBundle\Form\GarantiesTypes;

/**
 * Garanties controller.
 *
 */
class GarantiesAdminController extends Controller
{

    /**
     * Lists all Garanties entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EcommerceBundle:Garanties')->findAll();

        return $this->render('EcommerceBundle:Administration:Garanties/layout/index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Garanties entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Garanties();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('adminGaranties_show', array('id' => $entity->getId())));
        }

        return $this->render('EcommerceBundle:Administration:Garanties/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Garanties entity.
    *
    * @param Garanties $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Garanties $entity)
    {
        $form = $this->createForm(new GarantiesTypes(), $entity, array(
            'action' => $this->generateUrl('adminGaranties_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Garanties entity.
     *
     */
    public function newAction()
    {
        $entity = new Garanties();
        $form   = $this->createCreateForm($entity);

        return $this->render('EcommerceBundle:Administration:Garanties/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Garanties entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EcommerceBundle:Garanties')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Garanties entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EcommerceBundle:Administration:Garanties/layout/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Garanties entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EcommerceBundle:Garanties')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Garanties entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EcommerceBundle:Administration:Garanties/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Garanties entity.
    *
    * @param Garanties $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Garanties $entity)
    {
        $form = $this->createForm(new GarantiesTypes(), $entity, array(
            'action' => $this->generateUrl('adminGaranties_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Garanties entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EcommerceBundle:Garanties')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Garanties entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('adminGaranties_edit', array('id' => $id)));
        }

        return $this->render('EcommerceBundle:Administration:Garanties/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Garanties entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EcommerceBundle:Garanties')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Garanties entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('adminGaranties'));
    }

    /**
     * Creates a form to delete a Garanties entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminGaranties_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
