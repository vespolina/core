<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\CartBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('vespolina_cart');
        $rootNode
            ->children()
                ->scalarNode('db_driver')->cannotBeOverwritten()->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('pricing_provider')->cannotBeOverwritten()->end()
            ->end();

        $this->addCartSection($rootNode);
        $this->addCartItemSection($rootNode);

        return $treeBuilder;
    }

    private function addCartSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('cart')
                    ->children()
                        ->scalarNode('class')->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    private function addCartItemSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('cart_item')
                    ->children()
                        ->scalarNode('class')->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
