<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Order\Order;

class OrderTest extends \PHPUnit_Framework_TestCase
{
    public function testOrderData()
    {
        $order = new Order();
        $now = new \DateTime();
        $order->setOrderDate($now);

        $jamesBond = new \Vespolina\Entity\Partner\Partner();
        $jamesBond->setName('james bond');
        $order->setCustomer($jamesBond);

        $order->setCustomerNotes('i want it to be pink');
        $order->setInternalNotes('lizzen to me very carefully, i shall only say thiz onze');

        $this->assertEquals('i want it to be pink', $order->getCustomerNotes());
        $this->assertEquals('lizzen to me very carefully, i shall only say thiz onze', $order->getInternalNotes());
        $this->assertEquals($now, $order->getOrderDate());
        $this->assertEquals('james bond', $order->getCustomer()->getName());
    }

    public function testTotalPrice()
    {
        $order = new Order();
        $this->assertSame(0, $order->getPrice(), 'the total price should start out as 0');
        $this->assertSame(0, $order->getPrice('total'), 'the total price should start out as 0');
        $this->assertSame(0, $order->getTotalPrice(), 'the total price should start out as 0');
        $order->setPrice(35);
        $this->assertSame(35, $order->getTotalPrice('total'), 'the total should be set');
        $this->assertSame(35, $order->getTotalPrice(), 'the total should be set if no price type is passed');
        $this->assertSame(35, $order->getPrice(), 'if no type is set, the total should be returned');
        $order->setTotalPrice(70);
        $this->assertSame(70, $order->getTotalPrice('total'), 'the total should be set');
        $this->assertSame(70, $order->getTotalPrice(), 'it should match using get TotalPrice');
        $this->assertSame(70, $order->getPrice(), 'if no type is set, the total should be returned');
        $order->setPrice(105, 'something special');
        $this->assertSame(70, $order->getTotalPrice(), 'the Total price should not have been changed');
        $this->assertSame(70, $order->getPrice('total'), 'the Total price should not have been change');
        $this->assertSame(70, $order->getPrice(), 'the Total price should not have been change');
    }
}
