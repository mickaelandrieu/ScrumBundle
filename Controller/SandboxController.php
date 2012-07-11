<?php

namespace NicoB\ScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NicoB\ScrumBundle\Entity\Sandbox;
use NicoB\ScrumBundle\Form\SandboxType;

/**
 * Sandbox controller.
 *
 * @Route("/sandbox")
 */
class SandboxController extends Controller
{
    /**
     * Lists all Sandbox entities.
     *
     * @Route("/", name="sandbox")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NicoBScrumBundle:Sandbox')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Sandbox entity.
     *
     * @Route("/{id}/show", name="sandbox_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NicoBScrumBundle:Sandbox')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sandbox entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Sandbox entity.
     *
     * @Route("/new", name="sandbox_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Sandbox();
        $form   = $this->createForm(new SandboxType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Sandbox entity.
     *
     * @Route("/create", name="sandbox_create")
     * @Method("post")
     * @Template("NicoBScrumBundle:Sandbox:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Sandbox();
        $request = $this->getRequest();
        $form    = $this->createForm(new SandboxType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sandbox_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Sandbox entity.
     *
     * @Route("/{id}/edit", name="sandbox_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NicoBScrumBundle:Sandbox')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sandbox entity.');
        }

        $editForm = $this->createForm(new SandboxType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Sandbox entity.
     *
     * @Route("/{id}/update", name="sandbox_update")
     * @Method("post")
     * @Template("NicoBScrumBundle:Sandbox:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NicoBScrumBundle:Sandbox')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sandbox entity.');
        }

        $editForm   = $this->createForm(new SandboxType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sandbox_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Sandbox entity.
     *
     * @Route("/{id}/delete", name="sandbox_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NicoBScrumBundle:Sandbox')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Sandbox entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sandbox'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
