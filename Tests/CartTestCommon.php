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
use Vespolina\CartBundle\Handler\DefaultCartHandler;
use Vespolina\CartBundle\Pricing\DefaultCartPricingProvider;
use Vespolina\CartBundle\Tests\Fixtures\Document\Cartable;
use Vespolina\CartBundle\Tests\Fixtures\Document\RecurringCartable;

use Vespolina\ProductBundle\Model\RecurringInterface; // todo move to cart bundle

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard D Shank <develop@zestic.com>
 */
abstract class CartTestCommon extends WebTestCase
{
    protected $pricingProvider;

    protected function createCart($name = 'default')
    {
        $cart = $this->getMockForAbstractClass('Vespolina\CartBundle\Model\Cart', array($name));

        $sp = new \ReflectionProperty('Vespolina\CartBundle\Model\Cart', 'state');
        $sp->setAccessible(true);
        $sp->setValue($cart, Cart::STATE_OPEN);
        $sp->setAccessible(false);

        $pr = new \ReflectionProperty('Vespolina\CartBundle\Model\Cart', 'pricingSet');
        $pr->setAccessible(true);
        $pr->setValue($cart, $this->getPricingProvider()->createPricingSet());
        $pr->setAccessible(false);
        return $cart;
    }

    protected function createCartItem($cartableItem)
    {
        // todo: this should handle recurring interface
        $cartItem = $this->getMockForAbstractClass('Vespolina\CartBundle\Model\CartItem', array($cartableItem));
        $cartItem->setDescription($cartableItem->getName());

        if ($cartableItem instanceof RecurringInterface) {
            $irp = new \ReflectionProperty('Vespolina\CartBundle\Model\CartItem', 'isRecurring');
            $irp->setAccessible(true);
            $irp->setValue($cartItem, true);
            $irp->setAccessible(false);
        }

        //Pricing
        $prrp = new \ReflectionProperty('Vespolina\CartBundle\Model\CartItem', 'pricingSet');
        $prrp->setAccessible(true);
        $prrp->setValue($cartItem, $this->getPricingProvider()->createPricingSet());
        $prrp->setAccessible(false);

        return $cartItem;
    }

    protected function createCartableItem($name, $price)
    {
        $cartable = new Cartable();
        $cartable->setName($name);
        $cartable->setPricing(array('unitPrice' => $price));

        return $cartable;
    }

    protected function createRecurringCartableItem($name, $price)
    {
        $cartable = new RecurringCartable();
        $cartable->setName($name);
        $cartable->setPrice('unitPrice', $price);

        return $cartable;
    }

    protected function addItemToCart($cart, $cartableItem)
    {
        $cartItem = $this->createCartItem($cartableItem);
        $rm = new \ReflectionMethod($cart, 'addItem');
        $rm->setAccessible(true);
        $rm->invokeArgs($cart, array($cartItem));
        $rm->setAccessible(false);

        $prrp = new \ReflectionProperty('Vespolina\CartBundle\Model\CartItem', 'pricingSet');
        $prrp->setAccessible(true);
        $prrp->setValue($cartItem, $this->getPricingProvider()->createPricingSet());
        $prrp->setAccessible(false);

        $this->getPricingProvider()->determineCartPrices($cart);
        return $cartItem;
    }

    protected function getPricingProvider()
    {
        if (!$this->pricingProvider) {

            $this->pricingProvider = new DefaultCartPricingProvider();

            $this->pricingProvider->addCartHandler(new DefaultCartHandler());
        }

        return $this->pricingProvider;
    }

    protected function removeItemFromCart($cart, $cartItem)
    {
        $item = $cartItem;
        $rm = new \ReflectionMethod($cart, 'removeItem');
        $rm->setAccessible(true);
        $rm->invokeArgs($cart, array($cartItem));
        $rm->setAccessible(false);

        return $item;
    }

    protected function buildLoadedCart($name, $nonRecurringItems, $recurringItems = 0)
    {
        $itemNames = array('alpha', 'beta', 'gamma', 'delta', 'epsilon', 'zeta', 'eta', 'theta');

        if ($nonRecurringItems > 8 || $recurringItems > 8) {
            throw new \Exception('Really? You need more than 8 items?
            If you really do add more, add more letters to the $itemNames array in CartTestCommon::buildLoadedCart(),
            update the test for max items and put in a PR.');
        }

        $cart = $this->createCart($name);
        for ($i = 0; $i < $nonRecurringItems ; $i++) {
            $cartItem = $this->createCartableItem($itemNames[$i], $i+1);
            $this->addItemToCart($cart, $cartItem);
        }
        for ($i = 0; $i < $recurringItems ; $i++) {
            $cartItem = $this->createRecurringCartableItem('recurring-'.$itemNames[$i], $i+1);
            $this->addItemToCart($cart, $cartItem);
        }

        $this->getPricingProvider()->determineCartPrices($cart);

        return $cart;
    }
}
