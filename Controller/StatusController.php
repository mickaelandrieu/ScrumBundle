<?php

namespace NicoB\ScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NicoB\ScrumBundle\Entity\Status;
use NicoB\ScrumBundle\Form\StatusType;

/**
 * Status controller.
 *
 * @Route("/status")
 */
class StatusController extends Controller
{
    /**
     * Lists all Status entities.
     *
     * @Route("/", name="status")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NicoBScrumBundle:Status')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Status entity.
     *
     * @Route("/{id}/show", name="status_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NicoBScrumBundle:Status')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Status entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Status entity.
     *
     * @Route("/new", name="status_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Status();
        $form   = $this->createForm(new StatusType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Status entity.
     *
     * @Route("/create", name="status_create")
     * @Method("post")
     * @Template("NicoBScrumBundle:Status:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Status();
        $request = $this->getRequest();
        $form    = $this->createForm(new StatusType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('status_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Status entity.
     *
     * @Route("/{id}/edit", name="status_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NicoBScrumBundle:Status')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Status entity.');
        }

        $editForm = $this->createForm(new StatusType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Status entity.
     *
     * @Route("/{id}/update", name="status_update")
     * @Method("post")
     * @Template("NicoBScrumBundle:Status:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NicoBScrumBundle:Status')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Status entity.');
        }

        $editForm   = $this->createForm(new StatusType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('status_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Status entity.
     *
     * @Route("/{id}/delete", name="status_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NicoBScrumBundle:Status')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Status entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('status'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
