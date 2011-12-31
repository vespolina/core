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
        $product1->setName('Ipad 2 64GB');
        $product2 = $this->getMockForAbstractClass('Vespolina\ProductBundle\Document\BaseProduct');
        $product2->setName('Iphone 4S 64GB');


        $cart = $cartManager->createCart();

        $cart->setOwner($customerId);
        $cart->setExpiresAt(new \DateTime('now + 2 days'));

        $cartItem1 = $cartManager->createItem($product1);
        $cartItem1->setQuantity(10);

        $cartItem1->addOption($cartManager->createOption('color', 'colorRed'));
        $cartItem1->addOption($cartManager->createOption('size', 'sizeXl'));

        $cartItem1->setQuantity(3);
        $cartItem1->setState('init');

        $cart->addItem($cartItem1);

        $this->assertEquals($cartItem1->getDescription(), 'Ipad 2 64GB');

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
        $this->assertEquals(count($aCart->getItems()), 2);

        $aCartItem1 = $aCart->getItem(1);

        $this->assertEquals($aCartItem1->getOption('color')->getValue(), 'colorRed');


        //...and close it
        $aCart->setFollowUp('sales_order_12093488');
        $aCart->setState(Cart::STATE_CLOSED);

        $cartManager->updateCart($aCart, true);



        $aCart->clearItems();
        $this->assertEquals($aCart->getItems()->count(), 0);




    }

}