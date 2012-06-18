<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Event;

use \Symfony\Component\HttpKernel\Event\KernelEvent;
use \Vespolina\CartBundle\Model\CartInterface;

class CartPricingEvent extends KernelEvent
{
    /**
     * @var \Vespolina\CartBundle\Model\CartInterface $cart
     */
    protected $cart;

    public function __construct(CartInterface $cart, $pricingContext)
    {
        $this->cart = $cart;
        $this->pricingContext = $pricingContext;
    }

    public function getCart()
    {
        return $this->cart;
    }

    public function getPricingContext()
    {
        return $this->pricingContext;
    }
}