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
        
        $backlogs = $this->get('nicob.scrum.manager.backlog')->findBy(['project'=>5]);
        
        return array('backlogs' => $backlogs);
    }


}
