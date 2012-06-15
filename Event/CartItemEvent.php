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

class CartItemEvent extends KernelEvent
{
    /**
     * @var \Vespolina\CartBundle\Model\CartItemInterface $cartItem
     */
    protected $cartItem;

    public function __construct(CartItemInterface $cartItem)
    {
        $this->cartItem = $cartItem;
    }

    public function getCartItem()
    {
        return $this->cartItem;
    }
}