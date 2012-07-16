<?php

namespace NicoB\ScrumBundle\Form\Handler;

use NicoB\ScrumBundle\Manager\StoryManager;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Session\Session;
use NicoB\ScrumBundle\Manager\SandboxManager;

class StoryFormHandler extends BaseFormHandler {

    protected $securityContext;
    protected $manager;
    protected $sandboxManager;
    protected $session;

    public function __construct(Form $form, Request $request,Session $session, SecurityContext $securityContext, StoryManager $manager,SandboxManager $sandboxManager) {
        parent::__construct($form, $request);
        $this->securityContext = $securityContext;
        $this->manager = $manager;
        $this->sandboxManager = $sandboxManager;
        $this->session = $session;
    }

    public function onSuccess() {
        $story = $this->form->getData();
        $story->setCreatedBy($this->securityContext->getToken()->getUser());
        if (!$story->getBacklog())
        {
            $id = $this->session->get('project');
            $sandbox = $this->sandboxManager->findOneBy([
                'project' => $id
            ],true);
            $story->setSandbox($sandbox);
            
        }
        $this->manager->update($story);
    }

}
