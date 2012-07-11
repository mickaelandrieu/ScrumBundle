<?php

namespace NicoB\ScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NicoB\ScrumBundle\Entity\Difficulty;
use NicoB\ScrumBundle\Form\DifficultyType;

/**
 * Difficulty controller.
 *
 * @Route("/difficulty")
 */
class DifficultyController extends Controller
{
    /**
     * Lists all Difficulty entities.
     *
     * @Route("/", name="difficulty")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NicoBScrumBundle:Difficulty')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Difficulty entity.
     *
     * @Route("/{id}/show", name="difficulty_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NicoBScrumBundle:Difficulty')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Difficulty entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Difficulty entity.
     *
     * @Route("/new", name="difficulty_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Difficulty();
        $form   = $this->createForm(new DifficultyType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Difficulty entity.
     *
     * @Route("/create", name="difficulty_create")
     * @Method("post")
     * @Template("NicoBScrumBundle:Difficulty:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Difficulty();
        $request = $this->getRequest();
        $form    = $this->createForm(new DifficultyType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('difficulty_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Difficulty entity.
     *
     * @Route("/{id}/edit", name="difficulty_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NicoBScrumBundle:Difficulty')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Difficulty entity.');
        }

        $editForm = $this->createForm(new DifficultyType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Difficulty entity.
     *
     * @Route("/{id}/update", name="difficulty_update")
     * @Method("post")
     * @Template("NicoBScrumBundle:Difficulty:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NicoBScrumBundle:Difficulty')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Difficulty entity.');
        }

        $editForm   = $this->createForm(new DifficultyType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('difficulty_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Difficulty entity.
     *
     * @Route("/{id}/delete", name="difficulty_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NicoBScrumBundle:Difficulty')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Difficulty entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('difficulty'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
