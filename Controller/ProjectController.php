<?php

namespace NicoB\ScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NicoB\ScrumBundle\Entity\Project;
use NicoB\ScrumBundle\Form\ProjectType;
use NicoB\ScrumBundle\Entity\Sandbox;

/**
 * Project controller.
 *
 * @Route("/project")
 */
class ProjectController extends Controller {

    /**
     * Lists all Project entities.
     *
     * @Route("/", name="project")
     * @Template()
     */
    public function indexAction() {
        $manager = $this->get('nicob.scrum.project.manager');
        $entities = $manager->findAll();
        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Project entity.
     *
     * @Route("/{id}/show", name="project_show")
     * @Template()
     */
    public function showAction($id) {
        $manager = $this->get('nicob.scrum.project.manager');
        $project = $manager->find($id);
        
        if (!$project) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a new Project entity.
     *
     * @Route("/create", name="project_new")
     * @Template("NicoBScrumBundle:Project:new.html.twig")
     */
    public function newAction() {
        $handler = $this->get('nicob.scrum.project.form.handler');
        $manager = $this->get('nicob.scrum.project.manager');

        if ($handler->process()) {
            $project = $handler->getForm()->getData();
            $manager->update($project);

            return $this->redirect($this->generateUrl('project_show', array('id' => $project->getId())));
        }

        return array(
            'entity' => $project,
            'form' => $handler->getForm()->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Project entity.
     *
     * @Route("/{id}/edit", name="project_edit")
     * @Template()
     */
    public function editAction($id) {
        $handler = $this->get('nicob.scrum.project.form.handler');
        $manager = $this->get('nicob.scrum.project.manager');
        $project = $manager->find($id);

        if (!$project) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }

        if ($handler->process($project)) {
            $project = $handler->getForm()->getData();
            $manager->update($project);

            return $this->redirect($this->generateUrl('project_show', array('id' => $project->getId())));
        }

        return array(
            'entity' => $project,
            'form' => $handler->getForm()->createView(),
        );
    }

    /**
     * Deletes a Project entity.
     *
     * @Route("/{id}/delete", name="project_delete")
     * @Method("get")
     */
    public function deleteAction($id) {
        $manager = $this->get('nicob.scrum.project.manager');
        $project = $manager->find($id);

        if (!$project) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }

        $manager->delete($project);

        return $this->redirect($this->generateUrl('project'));
    }

}
