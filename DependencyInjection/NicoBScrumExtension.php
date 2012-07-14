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
        $container->setParameter('nicob.scrum.backlog.class', $config['backlog']['class']);
        $container->setParameter('nicob.scrum.project.class', $config['project']['class']);
        $container->setParameter('nicob.scrum.sandbox.class', $config['sandbox']['class']);
        $container->setParameter('nicob.scrum.story.class', $config['story']['class']);
        
        $container->setParameter('nicob.scrum.backlog.form.name', $config['backlog']['form']['name']);
        $container->setParameter('nicob.scrum.project.form.name', $config['project']['form']['name']);
        $container->setParameter('nicob.scrum.story.form.name', $config['story']['form']['name']);

        $loader->load('services.yml');
        
        $container->setAlias('nicob.scrum.backlog.manager', $config['backlog']['manager']);
        $container->setAlias('nicob.scrum.project.manager', $config['project']['manager']);
        $container->setAlias('nicob.scrum.story.manager', $config['story']['manager']);
        $container->setAlias('nicob.scrum.sandbox.manager', $config['sandbox']['manager']);


        $container->setAlias('nicob.scrum.backlog.form.handler', $config['backlog']['form']['handler']);

        $container->setAlias('nicob.scrum.project.form.handler', $config['project']['form']['handler']);
        $container->setAlias('nicob.scrum.project.form.type', $config['project']['form']['type']);

        $container->setAlias('nicob.scrum.story.form.handler', $config['story']['form']['handler']);




    }

}
