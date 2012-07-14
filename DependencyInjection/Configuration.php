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
                ->arrayNode('backlog')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('manager')->defaultValue('nicob.scrum.backlog.manager.default')->cannotBeEmpty()->end()
                        ->scalarNode('class')->defaultValue('NicoB\ScrumBundle\Entity\Backlog')->cannotBeEmpty()->end()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->defaultValue('nicob.scrum.backlog.form.type.default')->cannotBeEmpty()->end()
                                ->scalarNode('handler')->defaultValue('nicob.scrum.backlog.form.handler.default')->cannotBeEmpty()->end()
                                ->scalarNode('name')->defaultValue('backlog_form')->cannotBeEmpty()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('project')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('manager')->defaultValue('nicob.scrum.project.manager.default')->cannotBeEmpty()->end()
                        ->scalarNode('class')->defaultValue('NicoB\ScrumBundle\Entity\Project')->cannotBeEmpty()->end()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->defaultValue('nicob.scrum.project.form.type.default')->cannotBeEmpty()->end()
                                ->scalarNode('handler')->defaultValue('nicob.scrum.project.form.handler.default')->cannotBeEmpty()->end()
                                ->scalarNode('name')->defaultValue('project_form')->cannotBeEmpty()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('story')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('manager')->defaultValue('nicob.scrum.story.manager.default')->cannotBeEmpty()->end()
                        ->scalarNode('class')->defaultValue('NicoB\ScrumBundle\Entity\Story')->cannotBeEmpty()->end()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->defaultValue('nicob.scrum.story.form.type.default')->cannotBeEmpty()->end()
                                ->scalarNode('handler')->defaultValue('nicob.scrum.story.form.handler.default')->cannotBeEmpty()->end()
                                ->scalarNode('name')->defaultValue('story_form')->cannotBeEmpty()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('sandbox')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('manager')->defaultValue('nicob.scrum.sandbox.manager.default')->cannotBeEmpty()->end()
                        ->scalarNode('class')->defaultValue('NicoB\ScrumBundle\Entity\Sandbox')->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
