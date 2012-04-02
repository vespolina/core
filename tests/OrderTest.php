<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Tests;

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
        $this->assertType('array', $order->getItems());
        $this->assertContains($item, $order->getItems());
        $this->assertSame(1, count($order->getItems()));

        $items = array();
        $items[] = new Item();
        $items[] = new Item();
        $order->mergeItems($items);
        $this->assertSame(3, $order->getItems());

        $order->removeItem($item);
        $this->assertNotContains($item, $order->getItems());
        $this->assertSame(2, $order->getItems());

        $order->clearItems();
        $this->assertEmpty($order->getItems());

        $order->addItem($item);
        $order->setItems($items);
        $this->assertNotContains($item, $order->getItems(), 'this should have been removed on setting a new array of items');
        $this->assertSame(2, $order->getItems());

    }
}
