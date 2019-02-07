<?php

declare(strict_types=1);

namespace Setono\SyliusStrandsPlugin\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('setono_sylius_strands');

        $rootNode
            ->children()
                ->scalarNode('api_id')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->info('This can be found here: https://retail.strands.com/account/info/')
                ->end()
                ->booleanNode('variant_based')
                    ->defaultFalse()
                    ->info('If true the various injections will inject variant codes instead of product codes.')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
