<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

class VespolinaCartExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();

        $config = $processor->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        if (!in_array(strtolower($config['db_driver']), array('mongodb', 'orm'))) {
            throw new \InvalidArgumentException(sprintf('Invalid db driver "%s".', $config['db_driver']));
        }
        $loader->load(sprintf('%s.xml', $config['db_driver']));
        $loader->load('cart.xml');

        if (isset($config['cart'])) {
            $this->configureCart($config['cart'], $container);
        }

        if (isset($config['cart_item'])) {
            $this->configureCartItem($config['cart_item'], $container);
        }

        if (isset($config['pricing_provider'])) {
            $this->configureCartPricingProvider($config['pricing_provider'], $container);
        }

    }

    protected function configureCart(array $config, ContainerBuilder $container)
    {
        if (isset($config['class'])) {
            $container->setParameter('vespolina.cart.model.cart.class', $config['class']);
        }
    }

    protected function configureCartItem(array $config, ContainerBuilder $container)
    {
        if (isset($config['class'])) {
            $container->setParameter('vespolina.cart.model.cart_item.class', $config['class']);
        }
    }

    protected function configureCartPricingProvider(array $config, ContainerBuilder $container)
    {


        if (isset($config['enabled']) && !$config['enabled']) {

            $this->disablePricing($container);

        }

        if (isset($config['class'])) {
            $container->setParameter('vespolina.cart.pricing_provider.class', $config['class']);
        }
    }

    protected function disablePricing($container)
    {
        $cartManagerDefinition = $container->findDefinition('vespolina.cart.cart_manager');
        $cartManagerDefinition->replaceArgument(1, null);
    }
}