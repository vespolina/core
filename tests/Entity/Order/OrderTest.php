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

}
