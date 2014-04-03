<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Invoice\Invoice;
use Vespolina\Entity\Invoice\Item as InvoiceItem;
use Vespolina\Entity\Order\Item as OrderItem;
use Vespolina\Entity\Order\Order;

class InvoiceTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateInvoice()
    {
        $invoice = new Invoice();
        $this->assertEquals(count($invoice->getOrders()), 0, 'make sure we start without linked orders');

    }

    /**
     * Attach the order at header level (= the order itself)
     */
    public function testCreateInvoiceForOrder()
    {
        $invoice = new Invoice();

        $order = new Order();
        $this->assertEquals(count($invoice->getOrders()), 0, 'make sure we start out empty');

        //Reference the order only at header level
        $invoice->addOrder($order);

        $this->assertContains($order, $invoice->getOrders());
        $this->assertCount(1, $invoice->getOrders());

        $invoice->clearOrders();
        $this->assertEmpty($invoice->getOrders());

    }

    /**
     * Attach the order at item level (= the order item itself)
     */
    public function testCreateInvoiceItemForOrderItem()
    {

        $order = new Order();
        $orderItem = new OrderItem();
        $order->addItem($orderItem);

        $item = new InvoiceItem();
        $this->assertEquals(null, $item->getOrderItem());

        $item->setOrderItem($orderItem);
        $this->assertEquals($orderItem, $item->getOrderItem());
    }

}
