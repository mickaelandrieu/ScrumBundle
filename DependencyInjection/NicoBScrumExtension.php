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
        $container->setParameter('nicob.scrum.backlog.class', $config['class']['backlog']);
        $container->setParameter('nicob.scrum.difficulty.class', $config['class']['difficulty']);
        $container->setParameter('nicob.scrum.priority.class', $config['class']['priority']);
        $container->setParameter('nicob.scrum.project.class', $config['class']['project']);
        $container->setParameter('nicob.scrum.sandbox.class', $config['class']['sandbox']);
        $container->setParameter('nicob.scrum.status.class', $config['class']['status']);
        $container->setParameter('nicob.scrum.story.class', $config['class']['story']);
        $container->setParameter('nicob.scrum.type.class', $config['class']['type']);

        $loader->load('services.yml');
        $container->setAlias('nicob.scrum.backlog.manager', $config['manager']['backlog']);
        $container->setAlias('nicob.scrum.project.manager', $config['manager']['project']);
        $container->setAlias('nicob.scrum.story.manager', $config['manager']['story']);
        $container->setAlias('nicob.scrum.sandbox.manager', $config['manager']['sandbox']);
    }

}
