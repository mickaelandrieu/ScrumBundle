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
class StoryController extends Controller {

    public function getManager() {

        return $this->get('nicob.scrum.story.manager');
    }

    public function getHandler() {

        return $this->get('nicob.scrum.story.form.handler');
    }

    /**
     * Lists all Project entities.
     *
     * @Route("/project/{id_project}/story", name="scrum_story")
     * @Template()
     */
    public function indexAction($id_project) {
        return [
            'entities' => $this->getManager()->findAll(),
            'id_project' => $id_project,
        ];
    }

    /**
     * change story's status 
     *
     * @Route("/project/{id_project}/story/{id}/status/{id_status}", name="scrum_story_status")
     */
    public function statusAction($id_project, $id, $id_status) {
        $story = $this->getManager()->find($id);
        $user = $this->get('security.context')->getToken()->getUser();

        if ($id_status == 2)
            $story->setAssignedAt($user);


        //TODO : Create Status Manager
        $em = $this->getDoctrine()->getEntityManager();
        $status = $em->getRepository('NicoBScrumBundle:Status')->find($id_status);

        $story->setStatus($status);
        $this->getManager()->update($story);

        return $this->redirect($this->generateUrl('scrum_dashboard', [
                            'id_project' => $id_project
                        ]));
    }

    /**
     * Finds and displays a Project entity.
     *
     * @Route("/project/{id_project}/story/{id}/show", name="scrum_story_show")
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
     * @Route("/project/{id_project}/story/create", name="scrum_story_new")
     * @Template()
     */
    public function newAction($id_project) {
        $this->getHandler()->setProjectId($id_project);
        if ($this->getHandler()->process()) {
            $story = $this->getHandler()->getForm()->getData();
            $this->getManager()->update($story);

            return $this->redirect($this->generateUrl('scrum_story', ['id_project' => $id_project]));
        }

        return [
            'form' => $this->getHandler()->getForm()->createView(),
            'id_project' => $id_project,
        ];
    }

    /**
     * Displays a form to edit an existing Project entity.
     *
     * @Route("/project/{id_project}/story/{id}/edit", name="scrum_story_edit")
     * @Template()
     */
    public function editAction($id_project, $id) {
        $story = $this->getManager()->find($id, true);
        $this->getHandler()->setProjectId($id_project);
        
        if ($this->getHandler()->process($story)) {
            $story = $this->getHandler()->getForm()->getData();
            $this->getManager()->update($story);

            return $this->redirect($this->generateUrl('scrum_story', ['id_project' => $id_project]));
        }

        return [
            'entity' => $story,
            'form' => $this->getHandler()->getForm()->createView(),
            'id_project' => $id_project,
        ];
    }

    /**
     * Deletes a Project entity.
     *
     * @Route("/project/{id_project}/story/{id}/delete", name="scrum_story_delete")
     * @Method("get")
     */
    public function deleteAction($id) {
        $story = $this->getManager()->find($id, true);
        $this->getManager()->delete($story);

        return $this->redirect($this->generateUrl('story'));
    }

}
