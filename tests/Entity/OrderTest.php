<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Order;
use Vespolina\Entity\Item;

class OrderTest extends \PHPUnit_Framework_TestCase
{
    public function testItems()
    {
        $order = new Order();
        $this->assertNull($order->getItems(), 'make sure we start out empty');

        $item = new Item();
        $order->addItem($item);
        $this->assertContains($item, $order->getItems());
        $this->assertCount(1, $order->getItems());
        $this->assertSame($order, $item->getParent(), 'the order should be set in the item');

        $items = array();
        $items[] = new Item();
        $items[] = new Item();
        $order->mergeItems($items);
        $this->assertCount(3, $order->getItems());
        $this->assertContains($item, $order->getItems());

        $order->removeItem($item);
        $this->assertNotContains($item, $order->getItems());
        $this->assertCount(2, $order->getItems());

        $order->clearItems();
        $this->assertEmpty($order->getItems());

        $order->addItem($item);
        $order->setItems($items);
        $this->assertNotContains($item, $order->getItems(), 'this should have been removed on setting a new array of items');
        $this->assertCount(2, $order->getItems());
    }
}
