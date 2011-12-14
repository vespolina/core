<?php

namespace Vespolina\CartBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Vespolina\CartBundle\Model\Cart;
use Vespolina\CartBundle\Model\CartItem;
//use Vespolina\MerchandiseBundle\Model\Merchandise;
use Vespolina\ProductBundle\Model\Option\Option;


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

        $cart = $cartManager->createCart();
        $cart->setOwner(array('name' => 'steve jobs'));
        
        $cartItem1 = $cartManager->createItem($cart);
        $cartItem1->setQuantity(10);

        $product1 = $this->getMockForAbstractClass('Vespolina\ProductBundle\Model\Product');

        $cartItem1->addOption('color', 'colorRed');
        $cartItem1->addOption('size', 'sizeXl');

        $cartItem1->setProduct($product1);
        $cartItem1->setQuantity(3);

        $product2 = $this->getMockForAbstractClass('Vespolina\ProductBundle\Model\Product');

        $cartItem2 = $cartManager->createItem($cart);
        $cartItem2->setProduct($product2);
        $cartItem2->setQuantity(2);

        $testCartItem1 = $cart->getItem(1);

        $cartOwner = $cart->getOwner();
        $this->assertEquals($cartOwner['name'], 'steve jobs');


    }

}