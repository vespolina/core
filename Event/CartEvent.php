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

class CartEvent extends KernelEvent
{
    /**
     * @var \Vespolina\CartBundle\Model\CartInterface $cart
     */
    protected $cart;

    public function __construct(CartInterface $cart)
    {
        $this->cart = $cart;
    }

    public function getCart()
    {
        return $this->cart;
    }
}