<?php

// src/Acme/DemoBundle/Menu/Builder.php

namespace NicoB\ScrumBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Knp\Menu\Matcher\Matcher;
use Knp\Menu\Matcher\Voter\UriVoter;
use Knp\Menu\MenuFactory;
use Knp\Menu\Renderer\ListRenderer;

class Builder extends ContainerAware {

    public function mainMenu(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root');

        $menu->addChild('Dashboard', array('route' => 'home'));
        $menu->addChild('Project', array(
            'route' => 'project'
                // 'routeParameters' => array('id' => 42)
        ));

        return $menu;
    }

}