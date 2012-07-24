<?php

namespace NicoB\ScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Project controller.
 *
 */
class ProjectController extends Controller {

    public function getManager() {

        return $this->get('nicob.scrum.project.manager');
    }

    public function getHandler() {

        return $this->get('nicob.scrum.project.form.crud.handler');
    }

    /**
     * Lists all Project entities.
     *
     * @Route("/project/{id_project}/project", name="scrum_project")
     * @Template()
     */
    public function indexAction($id_project) {
        $entities = $this->getManager()->findAll();
        return [
            'entities' => $entities,
            'id_project' => $id_project,
        ];
    }

    /**
     * Finds and displays a Project entity.
     *
     * @Route("/project/{id_project}/project/{id}/show", name="scrum_project_show")
     * @Template()
     */
    public function showAction($id_project, $id) {
        return [
            'entity' => $this->getManager()->find($id, true),
            'id_project' => $id_project,
        ];
    }

    /**
     * Creates a new Project entity.
     *
     * @Route("/project/{id_project}/project/create", name="scrum_project_new")
     * @Template("NicoBScrumBundle:Project:new.html.twig")
     */
    public function newAction($id_project) {
        if ($this->getHandler()->process()) {
            return $this->redirect($this->generateUrl('project'));
        }

        return [
            'form' => $this->getHandler()->getForm()->createView(),
            'id_project' => $id_project,
        ];
    }

    /**
     * Displays a form to edit an existing Project entity.
     *
     * @Route("/project/{id_project}/project/{id}/edit", name="scrum_project_edit")
     * @Template()
     */
    public function editAction($id_project, $id) {
        $project = $this->getManager()->find($id, true);

        if ($this->getHandler()->process($project)) {
            return $this->redirect($this->generateUrl('project'));
        }

        return [
            'entity' => $project,
            'form' => $this->getHandler()->getForm()->createView(),
            'id_project' => $id_project,
        ];
    }

    /**
     * Deletes a Project entity.
     *
     * @Route("/project/{id_project}/project/{id}/delete", name="scrum_project_delete")
     * @Method("get")
     */
    public function deleteAction($id_project, $id) {
        $project = $this->getManager()->find($id, true);
        $this->getManager()->delete($project);

        return $this->redirect($this->generateUrl('scrum_project', [
                            'id_project' => $id_project
                        ]));
    }

    /**
     * Render form switcher in layout
     * getMethod() not work in twig embeded controller, so we work directly on request
     * @Template()
     */
    public function switcherAction() {
        $form = $this->get('nicob.scrum.project.form.switcher');
        if ($this->getRequest()->request->has('project_switcher_form')) {
            $id = $this->getRequest()->request->get('project_switcher_form')['project'];
            if (is_numeric($id)) {

                return $this->redirect('scrum_dashboard', [
                            'id_project' => $id
                        ]);
            }
        }


        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * Render form switcher in layout
     * For the moment use the embeded sitcherAction
     * @Route("/switcher", name="scrum_project_switcher")
     * @Template()
     */
    public function switcherPageAction() {
        $form = $this->get('nicob.scrum.project.form.switcher');
        if ($this->getRequest()->request->has('project_switcher_form')) {
            $id = $this->getRequest()->request->get('project_switcher_form')['project'];
            if (is_numeric($id)) {

                return $this->redirect($this->generateUrl('scrum_dashboard', [
                            'id_project' => $id
                        ]));
            }
        }


        return [
            'form' => $form->createView(),
        ];
    }

}
