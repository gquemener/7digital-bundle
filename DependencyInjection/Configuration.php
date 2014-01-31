<?php

namespace SevenDigital\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('seven_digital');

        $rootNode
            ->children()
                ->scalarNode('consumer_key')
                    ->info('Your 7digital API consumer key')
                ->end()
                ->scalarNode('version')
                    ->info('Version of the 7digital API')
                    ->defaultValue('1.2')
                ->end()
                ->scalarNode('cache')
                    ->info('Id of a doctrine cache service')
                    ->defaultNull()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
