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
        $id = $this->get('session')->get('project');
        $project = $this->get('nicob.scrum.project.manager')->find($id);
        
        return array('project' => $project);
    }


}
