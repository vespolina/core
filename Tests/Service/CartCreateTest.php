<?php

namespace Vespolina\CartBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Vespolina\CartBundle\Model\Cart;
use Vespolina\CartBundle\Model\CartItem;

class CartCreateTest extends WebTestCase
{
    protected $client;

    public function setUp()
    {
        $this->client = $this->createClient();
    }

    public function getKernel(array $options = array())
    {
        if (!$this->kernel) {
            $this->kernel = $this->createKernel($options);
            $this->kernel->boot();
        }

        return $this->kernel;
    }

    public function testCreateCart()
    {
        $cartService = $this->getKernel()->getContainer()->get('vespolina.cart');

        $cart = $cartService->createCart();
        $cart->setOwner(array('name' => 'steve jobs'));
        
        $cartItem1 = $cartService->createItem($cart);
        $cartItem1->setQuantity(10);

        $merchandise1 = array('id' => '123', '
                        name' => 'dummy instance of a product merchandise');

        $cartItem1->setOption('color', 'red');
        $cartItem1->setMerchandise($merchandise1);


        $cartItem2 = $cartService->createItem($cart);
        $cartItem2->setQuantity(2);

        $merchandise2 = array('id' => '123', '
                        name' => 'dummy instance of a product merchandise');

        $cartItem2->setMerchandise($merchandise2);

        $testCartItem1 = $cart->getItem(1);

        $this->assertEquals($testCartItem1->getOption('color'), 'red');

        $cartOwner = $cart->getOwner();
        $this->assertEquals($cartOwner['name'], 'steve jobs');


    }

}