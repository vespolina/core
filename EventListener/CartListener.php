<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\EventListener;

use Symfony\Component\DependencyInjection\Container;
use Vespolina\CartBundle\Event\CartEvent;
use Vespolina\CartBundle\Model\CartInterface;

class CartListener
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function onFinishCart(CartEvent $event)
    {
        $cart = $event->getCart();

        $this->container->get('vespolina.cart_manager')->determinePrices($cart);

    }

    protected function getMailBody(SalesOrder $salesOrder)
    {
        // @TODO: Make template configurable
        $twig = $this->container->get('twig');
        return $twig->render('VespolinaCartBundle:Email:checkout_complete.html.twig', array('order' => $salesOrder));
    }

}