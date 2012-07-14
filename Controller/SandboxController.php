<?php

namespace NicoB\ScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * Project controller.
 *
 * @Route("/sandbox")
 */
class SandboxController extends Controller {

    /**
     * Lists all Project entities.
     *
     * @Route("/", name="sandbox")
     * @Template()
     */
    public function indexAction() {
        $manager = $this->get('nicob.scrum.sandbox.manager');
        $entities = $manager->findAll();
        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Project entity.
     *
     * @Route("/{id}/show", name="sandbox_show")
     * @Template()
     */
    public function showAction($id) {
        $manager = $this->get('nicob.scrum.sandbox.manager');
        $sandbox = $manager->find($id,true);
        
        return array(
            'entity' => $sandbox
        );
    }

    /**
     * Creates a new Project entity.
     *
     * @Route("/create", name="sandbox_new")
     * @Template()
     */
    public function newAction() {
        $handler = $this->get('nicob.scrum.sandbox.form.handler');
        $manager = $this->get('nicob.scrum.sandbox.manager');

        if ($handler->process()) {
            $sandbox = $handler->getForm()->getData();
            $manager->update($sandbox);

            return $this->redirect($this->generateUrl('sandbox'));
        }

        return array(
            'form' => $handler->getForm()->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Project entity.
     *
     * @Route("/{id}/edit", name="sandbox_edit")
     * @Template()
     */
    public function editAction($id) {
        $handler = $this->get('nicob.scrum.sandbox.form.handler');
        $manager = $this->get('nicob.scrum.sandbox.manager');
        $sandbox = $manager->find($id,true);

        if ($handler->process($sandbox)) {
            $sandbox = $handler->getForm()->getData();
            $manager->update($sandbox);

            return $this->redirect($this->generateUrl('sandbox'));
        }

        return array(
            'entity' => $sandbox,
            'form' => $handler->getForm()->createView(),
        );
    }

    /**
     * Deletes a Project entity.
     *
     * @Route("/{id}/delete", name="sandbox_delete")
     * @Method("get")
     */
    public function deleteAction($id) {
        $manager = $this->get('nicob.scrum.sandbox.manager');
        $sandbox = $manager->find($id,true);

        $manager->delete($sandbox);

        return $this->redirect($this->generateUrl('sandbox'));
    }

}
