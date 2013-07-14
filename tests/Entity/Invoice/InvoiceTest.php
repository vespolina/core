<?php
/**
 * (c) 2012-2013 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Invoice\Invoice;
use Vespolina\Entity\Invoice\Item;
use Vespolina\Entity\Order\Order;

class InvoiceTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateInvoice()
    {
        $invoice = new Invoice();
        $this->assertEquals(count($invoice->getOrders()), 0, 'make sure we start out empty');

        $item = new Item();


        //Add an order reference to the invoice
        $order = new Order();
        $invoice->addOrder($order);
        $this->assertContains($order, $invoice->getOrders());
        $this->assertCount(1, $invoice->getOrders());

        $invoice->clearOrders();
        $this->assertEmpty($invoice->getOrders());

    }
}
