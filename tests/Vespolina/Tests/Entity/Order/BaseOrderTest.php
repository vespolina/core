<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Order\BaseOrder;
use Vespolina\Entity\Order\Item;
use Vespolina\Entity\Channel\Channel;

class BaseOrderTest extends \PHPUnit_Framework_TestCase
{
    public function testItems()
    {
        $order = new BaseOrder();
        $this->assertCount(0, $order->getItems(), 'make sure we start out empty');

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

    public function testAttributeMethods()
    {
        $order = new BaseOrder();

        $this->assertNull($order->getAttribute('noAttribute'));

        $order->addAttribute('attribute1', 1);
        $this->assertCount(1, $order->getAttributes());
        $this->assertSame(1, $order->getAttribute('attribute1'));

        $order->addAttribute('attribute2', 2);
        $this->assertCount(2, $order->getAttributes());
        $this->assertSame(2, $order->getAttribute('attribute2'));

        $order->removeAttribute('attribute2');
        $this->assertCount(1, $order->getAttributes(), 'remove by attribute');
        $this->assertNull($order->getAttribute('attribute2'));

        $attributes = array(
            'attribute2' => 2,
            'attribute3' => 3
        );

        $order->addAttributes($attributes);
        $this->assertCount(3, $order->getAttributes());
        $this->assertSame(2, $order->getAttribute('attribute2'));
        $this->assertSame(3, $order->getAttribute('attribute3'));

        $order->setAttributes($attributes);
        $this->assertCount(2, $order->getAttributes());
        $this->assertNull($order->getAttribute('attribute1'));
        $this->assertSame(2, $order->getAttribute('attribute2'));
        $this->assertSame(3, $order->getAttribute('attribute3'));

        $order->removeAttribute('attribute3');
        $this->assertCount(1, $order->getAttributes(), 'attribute should be removed by type');
        $order->removeAttribute('nada');
        $this->assertCount(1, $order->getAttributes());

        $order->clearAttributes();
        $this->assertEmpty($order->getAttributes());
    }

    public function testChannel()
    {
        $order = new BaseOrder();
        $channel = new Channel();
        $channel->setName('store1');
        $order->setChannel($channel);

        $this->assertEquals('store1', $order->getChannel()->getName());
    }
}
