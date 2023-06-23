<?php

namespace KnpLabs\Snappy\Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
      $treeBuilder = new TreeBuilder('snappy');

      $treeBuilder->getRootNode()
        ->children()
          ->arrayNode('wkhtmltopdf')
            ->children()
              ->scalarNode('binary_path')
                ->isRequired()
                ->cannotBeEmpty()
              ->end()
              ->arrayNode('options')
                ->useAttributeAsKey('name')
                ->scalarPrototype()->end()
              ->end()
            ->end()
          ->end()
          ->arrayNode('chromium')
            ->children()
              ->scalarNode('binary_path')
                ->isRequired()
                ->cannotBeEmpty()
              ->end()
              ->arrayNode('options')
                ->useAttributeAsKey('name')
                ->scalarPrototype()->end()
              ->end()
            ->end()
          ->end()
        ->end()
      ;

      return $treeBuilder;
    }
}
