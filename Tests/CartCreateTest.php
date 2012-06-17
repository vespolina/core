<?php

namespace Vespolina\CartBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Vespolina\CartBundle\Tests\CartTestCommon;
use Vespolina\CartBundle\Tests\Fixtures\Document\Cartable;

use Vespolina\CartBundle\Model\Cart;

class CartCreateTest extends CartTestCommon
{
    protected $client;

    public function setUp()
    {
        $this->client = $this->createClient();
    }

    public function getKernel(array $options = array())
    {
        if (!self::$kernel) {
            self::$kernel = $this->createKernel($options);
            self::$kernel->boot();
        }

        return self::$kernel;
    }

    public function testCreateCart()
    {
        $cartManager = $this->getKernel()->getContainer()->get('vespolina.cart_manager');

        $customerId = '1248934893';

        $product1 = $this->createProduct('Ipad 2', 'IPAD-2011', 499);

        $product2 = new Cartable();
        $product2->setName('Iphone 4S');
        $product2->setId('IPHONE-4S-2011');

        $cart = $cartManager->createCart();

        $cart->setOwner($customerId);
        $cart->setExpiresAt(new \DateTime('now + 2 days'));


        $cartItem1 = $cartManager->addItemToCart($cart, $product1);
        $cartManager->setItemQuantity($cartItem1, 10);
        $cartItem1->getPricingSet()->set('unitPrice', 499);

        $cartItem1->addOption('color', 'white');
        $cartItem1->addOption('connectivity', 'WIFI+3G');
        $cartItem1->addOption('size', '64GB');

        $cartManager->setItemQuantity($cartItem1, 3);
        $cartManager->setCartItemState($cartItem1, 'init');

        $this->assertEquals($cartItem1->getName(), $product1->getName());

        $cartItem2 = $cartManager->addItemToCart($cart, $product2);
        $cartManager->setItemQuantity($cartItem2, 2);

        $cartItem2->getPricingSet()->set('unitPrice', 699);
        $cartManager->setCartItemState($cartItem2, 'init');

        $testCartItem1 = $cart->getItem(1);

        $cartOwner = $cart->getOwner();
        $this->assertEquals($cartOwner, $customerId);


        //Calculate prices
        $cartManager->determinePrices($cart);

        $cartManager->updateCart($cart);

        //Step two, find back the open cart
        $aCart = $cartManager->findOpenCartByOwner($customerId);
        $this->assertEquals(count($aCart->getItems()), 2);

        $aCartItem1 = $aCart->getItem(1);

        $this->assertEquals($aCartItem1->getPricingSet()->get('unitPriceTotal'), 499);
        $this->assertEquals($aCartItem1->getOption('color'), 'white');

        //...and close it
        $aCart->setFollowUp('sales_order_12093488');
        $cartManager->setCartState($aCart, Cart::STATE_CLOSED);

        $cartManager->updateCart($aCart, true);

        $aCart->clearItems();
        $this->assertEquals($aCart->getItems()->count(), 0);

    }

    protected function createProduct($name, $id, $unitPriceTotal)
    {
        $product = new Cartable();
        $product->setName($name);
        $product->setId($id);

        $product->setPricing(array('unitPriceTotal' => $unitPriceTotal));

        return $product;
    }
}