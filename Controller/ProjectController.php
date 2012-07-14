<?php

namespace NicoB\ScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


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
        $project = $manager->find($id,true);
        
        return array(
            'entity' => $project
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

            return $this->redirect($this->generateUrl('project'));
        }

        return array(
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
        $project = $manager->find($id,true);

        if ($handler->process($project)) {
            $project = $handler->getForm()->getData();
            $manager->update($project);

            return $this->redirect($this->generateUrl('project'));
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
        $project = $manager->find($id,true);

        $manager->delete($project);

        return $this->redirect($this->generateUrl('project'));
    }

}
