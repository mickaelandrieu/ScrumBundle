<?php

namespace NicoB\ScrumBundle\Form\Handler;

use NicoB\ScrumBundle\Manager\ProjectManager;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use NicoB\ScrumBundle\Manager\BacklogManager;

class BacklogFormHandler extends BaseFormHandler
{

    protected $projectManager;
    protected $session;
    protected $manager;

    public function __construct(Form $form, Request $request,Session $session,ProjectManager $projectManager,BacklogManager $manager) {
        parent::__construct($form, $request);

        $this->projectManager = $projectManager;
        $this->session = $session;
        $this->manager = $manager;
    }

    public function onSuccess() {
        $backlog = $this->form->getData();
        
        $id = $this->session->get('project');
        $backlog->setProject($this->projectManager->find($id,true));
        $this->manager->update($backlog);
    }
}
