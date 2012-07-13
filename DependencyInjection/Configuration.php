<?php

namespace NicoB\ScrumBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('nicob_scrum');

        $rootNode
        ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('class')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('backlog')->defaultValue('NicoB\ScrumBundle\Entity\Backlog')->cannotBeEmpty()->end()
                        ->scalarNode('difficulty')->defaultValue('NicoB\ScrumBundle\Entity\Difficulty')->cannotBeEmpty()->end()
                        ->scalarNode('priority')->defaultValue('NicoB\ScrumBundle\Entity\Priority')->cannotBeEmpty()->end()
                        ->scalarNode('project')->defaultValue('NicoB\ScrumBundle\Entity\Project')->cannotBeEmpty()->end()
                        ->scalarNode('sandbox')->defaultValue('NicoB\ScrumBundle\Entity\Sandbox')->cannotBeEmpty()->end()
                        ->scalarNode('status')->defaultValue('NicoB\ScrumBundle\Entity\Status')->cannotBeEmpty()->end()
                        ->scalarNode('story')->defaultValue('NicoB\ScrumBundle\Entity\Story')->cannotBeEmpty()->end()
                        ->scalarNode('type')->defaultValue('NicoB\ScrumBundle\Entity\Type')->cannotBeEmpty()->end()
                    ->end()
                ->end()
                ->arrayNode('manager')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('backlog')->defaultValue('nicob.scrum.backlog.manager.default')->cannotBeEmpty()->end()
                        ->scalarNode('project')->defaultValue('nicob.scrum.project.manager.default')->cannotBeEmpty()->end()
                        ->scalarNode('story')->defaultValue('nicob.scrum.story.manager.default')->cannotBeEmpty()->end()
                        ->scalarNode('sandbox')->defaultValue('nicob.scrum.sandbox.manager.default')->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
