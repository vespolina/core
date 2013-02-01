<?php
/**
 * (c) 2013 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Billing\BillingRequest;
use Vespolina\Entity\Order\Item;

class BillingRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testItems()
    {
        $request = new BillingRequest();
        $this->assertEmpty($request->getOrderItems(), 'make sure we start out empty');

        $item = new Item();
        $request->addOrderItem($item);
        $this->assertContains($item, $request->getOrderItems());
        $this->assertCount(1, $request->getOrderItems());

        $items = array();
        $items[] = new Item();
        $items[] = new Item();
        $request->mergeOrderItems($items);
        $this->assertCount(3, $request->getOrderItems());
        $this->assertContains($item, $request->getOrderItems());

        $request->addOrderItem($item);
        $request->setOrderItems($items);
        $this->assertNotContains($item, $request->getOrderItems(), 'this should have been removed on setting a new array of items');
        $this->assertCount(2, $request->getOrderItems());
    }
}
