<?php

namespace NicoB\ScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class DashboardController extends Controller {

    
    public function getBacklogManager() {
        
        return $this->get('nicob.scrum.backlog.manager');
    }
    public function getStoryManager() {
        
        return $this->get('nicob.scrum.story.manager');
    }
    public function getProjectManager() {
        
        return $this->get('nicob.scrum.project.manager');
    }

    
    
    /**
     * @Route("/project/{id_project}/dashboard",name="scrum_dashboard")
     * @Template()
     */
    public function indexAction($id_project) {
        $project = $this->getProjectManager()->find($id_project);
        $currentBacklog = $this->getBacklogManager()->getCurrent($project);
        $sandbox = $project->getSandbox();
        
        return [
            'project' => $project,
            'id_project' => $id_project,
            'backlogStories' => $this->getStoryManager()->getOrderedStoriesByBacklog($currentBacklog),
            'sandboxStories' => $this->getStoryManager()->getOrderedStoriesBySandbox($sandbox),
            'backlog' => $this->getBacklogManager()->getCurrent($project)
            ];
    }


}
