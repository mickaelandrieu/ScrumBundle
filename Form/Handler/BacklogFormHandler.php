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
    protected $project;
    protected $session;
    protected $manager;

    public function __construct(Form $form, Request $request,Session $session,ProjectManager $projectManager,BacklogManager $manager) {
        parent::__construct($form, $request);

        $this->projectManager = $projectManager;
        $this->session = $session;
        $this->manager = $manager;
    }
    
    public function setProject($id){
        $this->project = $this->projectManager->find($id,true);
    }

    public function onSuccess() {
        $backlog = $this->form->getData();
        $backlog->setProject($this->project);
        $this->manager->update($backlog);
    }
}
