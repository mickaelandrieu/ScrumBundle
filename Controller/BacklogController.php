<?php

namespace NicoB\ScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * Project controller.
 *
 * @Route("/backlog")
 */
class BacklogController extends Controller {

    /**
     * Lists all Project entities.
     *
     * @Route("/", name="backlog")
     * @Template()
     */
    public function indexAction() {
        $manager = $this->get('nicob.scrum.backlog.manager');
        $entities = $manager->findAll();
        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Project entity.
     *
     * @Route("/{id}/show", name="backlog_show")
     * @Template()
     */
    public function showAction($id) {
        $manager = $this->get('nicob.scrum.backlog.manager');
        $backlog = $manager->find($id,true);
        
        return array(
            'entity' => $backlog
        );
    }

    /**
     * Creates a new Project entity.
     *
     * @Route("/create", name="backlog_new")
     * @Template()
     */
    public function newAction() {
        $handler = $this->get('nicob.scrum.backlog.form.handler');
        $manager = $this->get('nicob.scrum.backlog.manager');

        if ($handler->process()) {
            $backlog = $handler->getForm()->getData();
            $manager->update($backlog);

            return $this->redirect($this->generateUrl('backlog'));
        }

        return array(
            'form' => $handler->getForm()->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Project entity.
     *
     * @Route("/{id}/edit", name="backlog_edit")
     * @Template()
     */
    public function editAction($id) {
        $handler = $this->get('nicob.scrum.backlog.form.handler');
        $manager = $this->get('nicob.scrum.backlog.manager');
        $backlog = $manager->find($id,true);

        if ($handler->process($backlog)) {
            $backlog = $handler->getForm()->getData();
            $manager->update($backlog);

            return $this->redirect($this->generateUrl('backlog'));
        }

        return array(
            'entity' => $backlog,
            'form' => $handler->getForm()->createView(),
        );
    }

    /**
     * Deletes a Project entity.
     *
     * @Route("/{id}/delete", name="backlog_delete")
     * @Method("get")
     */
    public function deleteAction($id) {
        $manager = $this->get('nicob.scrum.backlog.manager');
        $backlog = $manager->find($id,true);

        $manager->delete($backlog);

        return $this->redirect($this->generateUrl('backlog'));
    }

}
