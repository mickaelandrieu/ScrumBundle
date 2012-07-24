<?php

namespace NicoB\ScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * Project controller.
 *
 * @Route("/")
 */
class BacklogController extends Controller {

    
    public function getManager() {
        
        return $this->get('nicob.scrum.backlog.manager');
    }
    public function getHandler() {

        return $this->get('nicob.scrum.backlog.form.handler');
    }
    
    /**
     * Lists all Project entities.
     *
     * @Route("/project/{id_project}/backlog", name="scrum_backlog")
     * @Template()
     */
    public function indexAction($id_project) {
        return [
            'entities' => $this->getManager()->findAll(),
            'id_project' => $id_project,
        ];
    }

    /**
     * Finds and displays a Project entity.
     *
     * @Route("/project/{id_project}/backlog/{id}/show", name="scrum_backlog_show")
     * @Template()
     */
    public function showAction($id_project,$id) {
        return [
            'entity' => $this->getManager()->find($id,true),
            'id_project' => $id_project
        ];
    }

    /**
     * Creates a new Project entity.
     *
     * @Route("/project/{id_project}/create", name="scrum_backlog_new")
     * @Template()
     */
    public function newAction($id_project) {

        if ($this->getHandler()->process()) {
            $backlog = $this->getHandler()->getForm()->getData();
            $this->getManager()->update($backlog);

            return $this->redirect($this->generateUrl('backlog'));
        }

        return [
            'form' => $this->getHandler()->getForm()->createView(),
            'id_project' => $id_project
        ];
    }

    /**
     * Displays a form to edit an existing Project entity.
     *
     * @Route("/project/{id_project}/backlog/{id}/edit", name="scrum_backlog_edit")
     * @Template()
     */
    public function editAction($id_project,$id) {
        $backlog = $this->getManager()->find($id,true);

        if ($this->getHandler()->process($backlog)) {
            $backlog = $this->getHandler()->getForm()->getData();
            $this->getManager()->update($backlog);

            return $this->redirect($this->generateUrl('backlog'));
        }

        return [
            'entity' => $backlog,
            'form' => $this->getHandler()->getForm()->createView(),
            'id_project' => $id_project
        ];
    }

    /**
     * Deletes a Project entity.
     *
     * @Route("project/{id_project}/backlog/{id}/delete", name="backlog_delete")
     * @Method("get")
     */
    public function deleteAction($id_project,$id) {
        $backlog = $this->getManager()->find($id,true);
        $this->getManager()->delete($backlog);

        return $this->redirect($this->generateUrl('backlog',[
            'id_project'=>$id_project
            ]
        ));
    }

}
