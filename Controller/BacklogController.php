<?php

namespace NicoB\ScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NicoB\ScrumBundle\Entity\Backlog;
use NicoB\ScrumBundle\Form\BacklogType;

/**
 * Backlog controller.
 *
 * @Route("/backlog")
 */
class BacklogController extends Controller
{
    /**
     * Lists all Backlog entities.
     *
     * @Route("/", name="backlog")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NicoBScrumBundle:Backlog')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Backlog entity.
     *
     * @Route("/{id}/show", name="backlog_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NicoBScrumBundle:Backlog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Backlog entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Backlog entity.
     *
     * @Route("/new", name="backlog_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Backlog();
        $form   = $this->createForm(new BacklogType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Backlog entity.
     *
     * @Route("/create", name="backlog_create")
     * @Method("post")
     * @Template("NicoBScrumBundle:Backlog:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Backlog();
        $request = $this->getRequest();
        $form    = $this->createForm(new BacklogType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backlog_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Backlog entity.
     *
     * @Route("/{id}/edit", name="backlog_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NicoBScrumBundle:Backlog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Backlog entity.');
        }

        $editForm = $this->createForm(new BacklogType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Backlog entity.
     *
     * @Route("/{id}/update", name="backlog_update")
     * @Method("post")
     * @Template("NicoBScrumBundle:Backlog:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NicoBScrumBundle:Backlog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Backlog entity.');
        }

        $editForm   = $this->createForm(new BacklogType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backlog_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Backlog entity.
     *
     * @Route("/{id}/delete", name="backlog_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NicoBScrumBundle:Backlog')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Backlog entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backlog'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
