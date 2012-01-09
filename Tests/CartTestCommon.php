<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\CartBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Vespolina\CartBundle\Model\Cart;
use Vespolina\CartBundle\Tests\Fixtures\Document\Cartable;

/**
 * @author Richard D Shank <develop@zestic.com>
 */
abstract class CartTestCommon extends WebTestCase
{
    protected function createCart($name)
    {
        $cart = $this->getMockForAbstractClass('Vespolina\CartBundle\Model\Cart', array($name));

        $sp = new \ReflectionProperty('Vespolina\CartBundle\Model\Cart', 'state');
        $sp->setAccessible(true);
        $sp->setValue($cart, Cart::STATE_OPEN);

        return $cart;
    }

    protected function createCartItem($cartableItem)
    {
        $cartItem = $this->getMockForAbstractClass('Vespolina\CartBundle\Model\CartItem', array($cartableItem));
        $cartItem->setDescription($cartableItem->getName());

        return $cartItem;
    }

    protected function createCartableItem($name, $price)
    {
        $cartable = new Cartable();
        $cartable->setName($name);
        $cartable->setPrice($price);

        return $cartable;
    }

    protected function addItemToCart($cart, $cartableItem)
    {
        $item = $this->createCartItem($cartableItem);
        $cart->addItem($item);

        return $item;
    }
}
