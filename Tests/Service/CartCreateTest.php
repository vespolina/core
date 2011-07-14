<?php

namespace Vespolina\CartBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Vespolina\CartBundle\Model\Cart;
use Vespolina\CartBundle\Model\CartItem;
use Vespolina\MerchandiseBundle\Model\Merchandise;


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

        $merchandise1 = new Merchandise();
        $cartItem1->setMerchandiseOption('color', 'red');
        $cartItem1->setMerchandise($merchandise1);


        $cartItem2 = $cartService->createItem($cart);
        $cartItem2->setQuantity(2);

        $merchandise2 = new Merchandise();

        $cartItem2->setMerchandise($merchandise2);

        $testCartItem1 = $cart->getItem(1);

        $this->assertEquals($testCartItem1->getMerchandiseOption('color'), 'red');

        $cartOwner = $cart->getOwner();
        $this->assertEquals($cartOwner['name'], 'steve jobs');


    }

}