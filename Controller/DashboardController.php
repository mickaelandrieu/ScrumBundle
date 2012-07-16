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
        $backlogs = $this->get('nicob.scrum.backlog.manager')->findBy(['project'=>$id]);
        
        return array('backlogs' => $backlogs);
    }


}
