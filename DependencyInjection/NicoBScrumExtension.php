<?php

namespace NicoB\ScrumBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class NicoBScrumExtension extends Extension {

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container) {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $container->setParameter('nicob.scrum.class.backlog', $config['class']['backlog']);
        $container->setParameter('nicob.scrum.class.difficulty', $config['class']['difficulty']);
        $container->setParameter('nicob.scrum.class.priority', $config['class']['priority']);
        $container->setParameter('nicob.scrum.class.project', $config['class']['project']);
        $container->setParameter('nicob.scrum.class.sandbox', $config['class']['sandbox']);
        $container->setParameter('nicob.scrum.class.status', $config['class']['status']);
        $container->setParameter('nicob.scrum.class.story', $config['class']['story']);
        $container->setParameter('nicob.scrum.class.type', $config['class']['type']);

        $loader->load('services.yml');
        $container->setAlias('nicob.scrum.manager.backlog', $config['manager']['backlog']);
        $container->setAlias('nicob.scrum.manager.project', $config['manager']['project']);
        $container->setAlias('nicob.scrum.manager.story', $config['manager']['story']);
        $container->setAlias('nicob.scrum.manager.sandbox', $config['manager']['sandbox']);
    }

}
