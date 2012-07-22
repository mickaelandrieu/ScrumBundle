<?php

namespace NicoB\ScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class DashboardController extends Controller {

    /**
     * @Route("/",name="home")
     * @Template()
     */
    public function indexAction() {
        $backlogManager=$this->get('nicob.scrum.backlog.manager');
        $storyManager=$this->get('nicob.scrum.story.manager');
        $id = $this->get('session')->get('project');

        $project = $this->get('nicob.scrum.project.manager')->find($id);
        $currentBacklog = $backlogManager->getCurrent($project);
        $sandbox = $project->getSandbox();
        
        return array(
            'project' => $project,
            'backlogStories' => $storyManager->getOrderedStoriesByBacklog($currentBacklog),
            'sandboxStories' => $storyManager->getOrderedStoriesBySandbox($sandbox),
            'backlog' => $backlogManager->getCurrent($project)
            );
    }


}
