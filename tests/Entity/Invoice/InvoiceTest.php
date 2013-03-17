<?php
/**
 * (c) 2012-2013 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Invoice\Invoice;
use Vespolina\Entity\Order\Order;

class InvoiceTest extends \PHPUnit_Framework_TestCase
{
    public function testOrders()
    {
        $invoice = new Invoice();
        $this->assertEquals($invoice->getOrders()->count(), 0, 'make sure we start out empty');

        $order = new Order();
        $invoice->addOrder($order);
        $this->assertContains($order, $invoice->getOrders());
        $this->assertCount(1, $invoice->getOrders());

        $orders = array();
        $orders[] = new Order();
        $orders[] = new Order();
        $invoice->mergeOrders($orders);
        $this->assertCount(3, $invoice->getOrders());
        $this->assertContains($order, $invoice->getOrders());

        $invoice->removeOrder($order);
        $this->assertNotContains($order, $invoice->getOrders());
        $this->assertCount(2, $invoice->getOrders());

        $invoice->clearOrders();
        $this->assertEmpty($invoice->getOrders());

        $invoice->addOrder($order);
        $invoice->setOrders($orders);
        $this->assertNotContains($order, $invoice->getOrders(), 'this should have been removed on setting a new array of orders');
        $this->assertCount(2, $invoice->getOrders());
    }
}
