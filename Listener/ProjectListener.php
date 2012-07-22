<?php

namespace NicoB\ScrumBundle\Listener;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/*
 * This file is part of the NicoBScrumBundle package.
 *
 * (c) Nicolas Badey
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Nicolas Badey <nicolas.badey@gmail.com>
 */

class ProjectListener  {
    
    protected $session;
    protected $router;
    
    public function __construct(Session $session,Router $router) {
        $this->session = $session;
        $this->router = $router;
        
    }
    
    /**
     * Invoked after the response has been created.
     * 
     * @param FilterResponseEvent $event The event
     */
    public function onKernelResponse(FilterResponseEvent $event) {
        if ($event->getRequestType() != HttpKernelInterface::MASTER_REQUEST) {
            return;
        }
        /*
        if (!$this->session->has('project') && $event->getRequest()->attributes->get('_route') != 'project_switcher'){
            $redirectResponse = new RedirectResponse($this->router->generate('project_switcher'));
            $event->setResponse($redirectResponse);
        }*/
    }

}