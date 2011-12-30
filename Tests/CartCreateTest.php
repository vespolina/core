<?php

namespace Vespolina\CartBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Vespolina\CartBundle\Model\Cart;


class CartCreateTest extends WebTestCase
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

        $product1 = $this->getMockForAbstractClass('Vespolina\ProductBundle\Document\BaseProduct');
        $product2 = $this->getMockForAbstractClass('Vespolina\ProductBundle\Document\BaseProduct');


        $cart = $cartManager->createCart();

        $cart->setOwner($customerId);
        $cart->setExpiresAt(new \DateTime('now + 2 days'));

        $cartItem1 = $cartManager->createItem($product1);
        $cartItem1->setQuantity(10);

        $cartItem1->addOption('color', 'colorRed');
        $cartItem1->addOption('size', 'sizeXl');

        $cartItem1->setQuantity(3);
        $cartItem1->setState('init');

        $cart->addItem($cartItem1);

        $cartItem2 = $cartManager->createItem($product2);
        $cartItem2->setQuantity(2);
        $cartItem1->setState('init');

        $cart->addItem($cartItem2);

        $testCartItem1 = $cart->getItem(1);

        $cartOwner = $cart->getOwner();
        $this->assertEquals($cartOwner, $customerId);



        $cartManager->updateCart($cart);



        //Step two, find back the open cart
        $aCart = $cartManager->findOpenCartByOwner($customerId);
        $this->assertEquals(count($cart->getItems()), 2);

        //...and close it
        $aCart->setState(Cart::STATE_CLOSED);

        $cartManager->updateCart($aCart, true);




    }

}