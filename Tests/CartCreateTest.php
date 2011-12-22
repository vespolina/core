<?php

namespace Vespolina\CartBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


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

        $product1 = $this->getMockForAbstractClass('Vespolina\ProductBundle\Document\BaseProduct');
        $product2 = $this->getMockForAbstractClass('Vespolina\ProductBundle\Document\BaseProduct');


        $cart = $cartManager->createCart();

        $cart->setOwner(array('name' => 'steve jobs'));
        $cart->setExpiresAt(new \DateTime('now + 2 days'));
        $cart->setState('unprocessed'); //Cart is under full control of the user
        
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
        $this->assertEquals($cartOwner['name'], 'steve jobs');


        $cart->setState('saved_basket');

        $cartManager->updateCart($cart);
    }

}