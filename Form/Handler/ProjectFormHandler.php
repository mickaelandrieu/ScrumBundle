<?php

namespace NicoB\ScrumBundle\Form\Handler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use Symfony\Component\Security\Core\SecurityContext;
use NicoB\ScrumBundle\Manager\ProjectManager;
use NicoB\ScrumBundle\Manager\SandboxManager;

class ProjectFormHandler extends BaseFormHandler {
    
    protected $securityContext;
    protected $userManager;
    protected $sandboxManager;

    public function __construct(Form $form, Request $request,SecurityContext $securityContext,ProjectManager $manager,SandboxManager $sandboxManager) {
        parent::__construct($form, $request);
        $this->securityContext = $securityContext;
        $this->manager = $manager;
        $this->sandboxManager = $sandboxManager;
    }

    public function onSuccess() {
        $project = $this->form->getData();
        $project->setCreatedBy($this->securityContext->getToken()->getUser());
        $sandbox = $this->sandboxManager->create();
        $sandbox->setProject($project);
        $project->setSandbox($sandbox);
        $this->manager->update($project);
    }

}
