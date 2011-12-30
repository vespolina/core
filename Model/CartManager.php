<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Model;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Bundle\Bundle;

use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\CartBundle\Model\CartItemInterface;
use Vespolina\CartBundle\Model\CartManagerInterface;

abstract class CartManager extends ContainerAware implements CartManagerInterface
{

    function __construct()
    {
    }


    public function init(CartInterface $cart) {

        //Set default state (for now we set it to "open")
        $cart->setState(Cart::STATE_OPEN);
    }

    public function initItem(CartItemInterface $cartItem) {

    }
    

}