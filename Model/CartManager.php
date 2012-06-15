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

use Vespolina\CartBundle\CartEvents;
use Vespolina\CartBundle\Event\CartEvent;
use Vespolina\CartBundle\Model\CartableItemInterface;
use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\CartBundle\Model\CartItemInterface;
use Vespolina\CartBundle\Model\CartManagerInterface;
use Vespolina\CartBundle\Pricing\CartPricingProviderInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
abstract class CartManager implements CartManagerInterface
{
    protected $cartClass;
    protected $cartItemClass;
    protected $dispatcher;
    protected $pricingProvider;
    protected $recurringInterface;

    // todo: $recurringInterface should be handled in a handler
    function __construct(CartPricingProviderInterface $pricingProvider, $cartClass, $cartItemClass, $recurringInterface = 'Vespolina\ProductSubscriptionBundle\Model\RecurringInterface')
    {
        $this->cartClass = $cartClass;
        $this->cartItemClass = $cartItemClass;
        $this->pricingProvider = $pricingProvider;
        $this->recurringInterface = $recurringInterface;
    }
    
    /**
     * @inheritdoc
     */
    public function addItemToCart(CartInterface $cart, CartableItemInterface $cartableItem)
    {
        $item = $this->doAddItemToCart($cart, $cartableItem);

        return $item;
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

    /**
     * @inheritdoc
     */
    public function determinePrices(CartInterface $cart, $determineItemPrices = true)
    {
        $pricingProvider = $this->getPricingProvider();
        $pricingProvider->determineCartPrices($cart, null, $determineItemPrices);
    }

    /**
     * @inheritdoc
     */
    public function finishCart(CartInterface $cart)
    {
        if (null != $this->dispatcher) {

            $this->dispatcher->dispatch(CartEvents::CART_FINISHED,  new CartEvent($cart));
        }
    }

    /**
     * @inheritdoc
     */
    public function getPricingProvider()
    {
        return $this->pricingProvider;
    }

    /**
     * @inheritdoc
     */
    public function initCart(CartInterface $cart)
    {
        // Create the pricing set to hold cart level pricing data
        $this->setCartPricingSet($cart, $this->pricingProvider->createPricingSet());

        // Set default state (for now we set it to "open"), do this last since it will persist and flush the cart
        $this->setCartState($cart, Cart::STATE_OPEN);
    }

    public function initCartItem(CartItemInterface $cartItem)
    {
        // todo: this should be moved into a handler
        //Default cart item description to the product name
        if ($cartableItem = $cartItem->getCartableItem()) {
            $cartItem->setName($cartableItem->getCartableName());
            $cartItem->setDescription($cartItem->getName());
            $rpPricingSet = new \ReflectionProperty($cartItem, 'pricingSet');
            $rpPricingSet->setAccessible(true);
            $rpPricingSet->setValue($cartItem, $this->getPricingProvider()->createPricingSet());
            $rpPricingSet->setAccessible(false);
            // todo: especially this damn thing, and get the Interface out of the __construct
            if ($cartableItem instanceof $this->recurringInterface) {
                $rp = new \ReflectionProperty($cartItem, 'isRecurring');
                $rp->setAccessible(true);
                $rp->setValue($cartItem, true);
                $rp->setAccessible(false);
            }
        }
    }

    public function setCartPricingSet(CartInterface $cart, $pricingSet)
    {
        $rp = new \ReflectionProperty($cart, 'pricingSet');
        $rp->setAccessible(true);
        $rp->setValue($cart, $pricingSet);
        $rp->setAccessible(false);
    }

    public function setEventDispatcher($dispatcher) {

        $this->dispatcher = $dispatcher;
    }

    public function setCartState(CartInterface $cart, $state)
    {
        $rp = new \ReflectionProperty($cart, 'state');
        $rp->setAccessible(true);
        $rp->setValue($cart, $state);
        $rp->setAccessible(false);
    }

    public function findItemInCart(CartInterface $cart, CartableItemInterface $cartableItem)
    {
        foreach ($cart->getItems() as $item)
        {
            if ($item->getCartableItem() == $cartableItem) {
                return $item;
            };
        }

        return null;
    }

    public function removeItemFromCart(CartInterface $cart, CartableItemInterface $cartableItem, $flush = true)
    {
        $this->doRemoveItemFromCart($cart, $cartableItem);
    }

    public function setItemQuantity(CartItemInterface $cartItem, $quantity)
    {
        // add item to cart
        $rm = new \ReflectionMethod($cartItem, 'setQuantity');
        $rm->setAccessible(true);
        $rm->invokeArgs($cartItem, array($quantity));
        $rm->setAccessible(false);
    }

    protected function doAddItemToCart(CartInterface $cart, CartableItemInterface $cartableItem)
    {
        if ($cartItem = $this->findItemInCart($cart, $cartableItem)) {
            $quantity = $cartItem->getQuantity() + 1;
            $this->setItemQuantity($cartItem, $quantity);

            return $cartItem;
        }

        $item = $this->createItem($cartableItem);

        // add item to cart
        $rm = new \ReflectionMethod($cart, 'addItem');
        $rm->setAccessible(true);
        $rm->invokeArgs($cart, array($item));
        $rm->setAccessible(false);

        return $item;
    }

    protected function doRemoveItemFromCart(CartInterface $cart, CartableItemInterface $cartableItem)
    {
        $item = $this->findItemInCart($cart, $cartableItem);

        // add item to cart
        $rm = new \ReflectionMethod($cart, 'removeItem');
        $rm->setAccessible(true);
        $rm->invokeArgs($cart, array($item));
        $rm->setAccessible(false);
    }
}
