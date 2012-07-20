<?php

namespace NicoB\ScrumBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;


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
        ->addDefaultsIfNotSet();

        $this->addProjectSection($rootNode);
        $this->addBacklogSection($rootNode);
        $this->addSandboxSection($rootNode);
        $this->addStorySection($rootNode);
        
        
        return $treeBuilder;
    }
    private function addProjectSection(ArrayNodeDefinition $node)
    {
        $node
        ->children()
                ->arrayNode('project')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('manager')->defaultValue('nicob.scrum.project.manager.default')->cannotBeEmpty()->end()
                        ->scalarNode('class')->defaultValue('NicoB\ScrumBundle\Entity\Project')->cannotBeEmpty()->end()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('crud')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('type')->defaultValue('nicob.scrum.project.form.crud.type.default')->cannotBeEmpty()->end()
                                        ->scalarNode('handler')->defaultValue('nicob.scrum.project.form.crud.handler.default')->cannotBeEmpty()->end()
                                        ->scalarNode('name')->defaultValue('project_form')->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            
                                ->arrayNode('switcher')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('type')->defaultValue('nicob.scrum.project.form.switcher.type.default')->cannotBeEmpty()->end()
                                        ->scalarNode('name')->defaultValue('project_switcher_form')->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
         ->end()
        ;
    }
    private function addBacklogSection(ArrayNodeDefinition $node)
    {
        $node
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
         ->end()
        ;
    }
    private function addSandboxSection(ArrayNodeDefinition $node)
    {
        $node
        ->children()
               ->arrayNode('sandbox')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('manager')->defaultValue('nicob.scrum.sandbox.manager.default')->cannotBeEmpty()->end()
                        ->scalarNode('class')->defaultValue('NicoB\ScrumBundle\Entity\Sandbox')->cannotBeEmpty()->end()
                    ->end()
                ->end()
         ->end()
        ;
    }
    private function addStorySection(ArrayNodeDefinition $node)
    {
        $node
        ->children()
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
         ->end()
        ;
    }
}
