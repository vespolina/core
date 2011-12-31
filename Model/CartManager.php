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

class CartManager extends ContainerAware implements CartManagerInterface
{
    protected $carts;

    function __construct()
    {
        $this->carts = array();
    }

    /**
     * @inheritdoc
     */
    public function createCart($name = 'default')
    {
        $cartClass = 'Vespolina\CartBundle\Model\Cart';
        $cart = new $cartClass($name);
        $this->carts[$name] = $cart;

        return $cart;
    }

    public function init(CartInterface $cart)
    {

    }

    public function initItem(CartItemInterface $cartItem)
    {

    }

    /**
     * @inheritdoc
     */
    public function save(CartInterface $cart)
    {
    }
}