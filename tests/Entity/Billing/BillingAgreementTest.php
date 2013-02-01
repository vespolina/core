<?php
/**
 * (c) 2013 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Billing\BillingAgreement;
use Vespolina\Entity\Order\Item;

class BillingAgreementTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $billingAgreement = new BillingAgreement();
        $this->assertTrue($billingAgreement->getActive());
        $this->assertEquals(0, $billingAgreement->getNumberCyclesBilled());
    }

    public function testItems()
    {
        $agreement = new BillingAgreement();
        $this->assertEmpty($agreement->getOrderItems(), 'make sure we start out empty');

        $item = new Item();
        $agreement->addOrderItem($item);
        $this->assertContains($item, $agreement->getOrderItems());
        $this->assertCount(1, $agreement->getOrderItems());

        $items = array();
        $items[] = new Item();
        $items[] = new Item();

        $agreement->addOrderItem($item);
        $agreement->setOrderItems($items);
        $this->assertNotContains($item, $agreement->getOrderItems(), 'this should have been removed on setting a new array of items');
        $this->assertCount(2, $agreement->getOrderItems());
    }

    public function testSetCurrentCycleComplete()
    {
        $this->markTestIncomplete('the next billing day should move ahead by the interval');
        $this->markTestIncomplete('the total number of cycles should have increased');
    }


}
