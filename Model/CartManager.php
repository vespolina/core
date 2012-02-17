<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Model;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Bundle\Bundle;

use Vespolina\CartBundle\Model\CartableItemInterface;
use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\CartBundle\Model\CartItemInterface;
use Vespolina\CartBundle\Model\CartManagerInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
abstract class CartManager implements CartManagerInterface
{
    protected $cartClass;
    protected $cartItemClass;
    protected $pricingProvider;
    protected $pricingProviderClass;

    protected $recurringInterface;

    function __construct($cartClass, $cartItemClass, $pricingProviderClass, $recurringInterface = 'Vespolina\ProductBundle\Model\RecurringInterface')
    {
        $this->cartClass = $cartClass;
        $this->cartItemClass = $cartItemClass;
        $this->pricingProviderClass = $pricingProviderClass;
        $this->recurringInterface = $recurringInterface;
    }

    /**
     * @inheritdoc
     */
    public function createCart($cartType = 'default')
    {
        $cart = new $this->cartClass($cartType);
        $this->initCart($cart);

        return $cart;
    }

    /**
     * @inheritdoc
     */
    public function createItem(CartableItemInterface $cartableItem = null)
    {
        $cartItem = new $this->cartItemClass($cartableItem);
        $this->initCartItem($cartItem);

        return $cartItem;
    }

    public function getPricingProvider()
    {
        if (!$this->pricingProvider && $this->pricingProviderClass) {

            $this->pricingProvider = new $this->pricingProviderClass();
        }

        return $this->pricingProviderClass;
    }

    public function initCart(CartInterface $cart)
    {
        //Set default state (for now we set it to "open")
        $this->setCartState($cart, Cart::STATE_OPEN);
    }

    public function initCartItem(CartItemInterface $cartItem)
    {
        //Default cart item description to the product name
        if ($cartableItem = $cartItem->getCartableItem()) {
            $cartItem->setName($cartableItem->getCartableName());
            if ($cartableItem instanceof $this->recurringInterface) {
                $rp = new \ReflectionProperty($cartItem, 'isRecurring');
                $rp->setAccessible(true);
                $rp->setValue($cartItem, true);
                $rp->setAccessible(false);
            }
        }
    }

    public function determinePrices(CartInterface $cart)
    {

        if ($pricingProvider = $this->getPricingProvider()) {

            $pricingContextContainer = $pricingProvider->createPricingContextContainer();
            $pricingProvider->determineCartPrices($cart, $pricingContextContainer, true);
        }


    }

    public function setCartState(CartInterface $cart, $state, $flush = true)
    {
        $rp = new \ReflectionProperty($cart, 'state');
        $rp->setAccessible(true);
        $rp->setValue($cart, $state);
        $rp->setAccessible(false);

        if ($flush) {
            $this->updateCart($cart);
        }
    }
}
