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
        
        $cartItem1 = $cartService->createItem($cart);
        $cartItem1->setAttribute('quantity', 10);

        $product1 = array('id' => '123', '
                        name' => 'dummy instance of a product');

        $cartItem1->setAttribute('product', $product1);
        $cartItem1->setAttribute('product.options.color', 'red');


        $cartItem2 = $cartService->createItem($cart);
        $cartItem2->setAttribute('quantity', 2);

        $product2 = array('id' => '123', '
                        name' => 'dummy instance of a product');

        $cartItem2->setAttribute('product', $product2);

        $testCartItem1 = $cart->getItem(1);

        $this->assertEquals($testCartItem1->getAttribute('product.options.color'), 'red');


    }

}