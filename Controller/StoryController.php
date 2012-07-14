<?php

namespace NicoB\ScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * Project controller.
 *
 * @Route("/story")
 */
class StoryController extends Controller {

    /**
     * Lists all Project entities.
     *
     * @Route("/", name="story")
     * @Template()
     */
    public function indexAction() {
        $manager = $this->get('nicob.scrum.story.manager');
        $entities = $manager->findAll();
        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Project entity.
     *
     * @Route("/{id}/show", name="story_show")
     * @Template()
     */
    public function showAction($id) {
        $manager = $this->get('nicob.scrum.story.manager');
        $story = $manager->find($id,true);
        
        return array(
            'entity' => $story
        );
    }

    /**
     * Creates a new Project entity.
     *
     * @Route("/create", name="story_new")
     * @Template()
     */
    public function newAction() {
        $handler = $this->get('nicob.scrum.story.form.handler');
        $manager = $this->get('nicob.scrum.story.manager');

        if ($handler->process()) {
            $story = $handler->getForm()->getData();
            $manager->update($story);

            return $this->redirect($this->generateUrl('story'));
        }

        return array(
            'form' => $handler->getForm()->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Project entity.
     *
     * @Route("/{id}/edit", name="story_edit")
     * @Template()
     */
    public function editAction($id) {
        $handler = $this->get('nicob.scrum.story.form.handler');
        $manager = $this->get('nicob.scrum.story.manager');
        $story = $manager->find($id,true);

        if ($handler->process($story)) {
            $story = $handler->getForm()->getData();
            $manager->update($story);

            return $this->redirect($this->generateUrl('story'));
        }

        return array(
            'entity' => $story,
            'form' => $handler->getForm()->createView(),
        );
    }

    /**
     * Deletes a Project entity.
     *
     * @Route("/{id}/delete", name="story_delete")
     * @Method("get")
     */
    public function deleteAction($id) {
        $manager = $this->get('nicob.scrum.story.manager');
        $story = $manager->find($id,true);

        $manager->delete($story);

        return $this->redirect($this->generateUrl('story'));
    }

}
