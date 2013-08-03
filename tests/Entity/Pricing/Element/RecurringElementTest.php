<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Pricing\Element\RecurringElement;

class RecurringElementTest extends \PHPUnit_Framework_TestCase
{
    public function testDoProcess()
    {
        $recurringElement = new RecurringElement();
        $recurringElement->setCycles(-1);
        $recurringElement->setInterval('1 month');
        $recurringElement->setRecurringCharge('30');

        $context = new \Vespolina\Entity\Pricing\PricingContext();
        $processed = $recurringElement->process($context, array());

        $comparisonTime = new \DateTime('today +1 month');
        $this->assertEquals($comparisonTime->format('c'), $processed['properties']['startsOn']);

        $recurringElement->setStartsIn('15 days');
        $processed = $recurringElement->process($context, array());
        $comparisonTime = new \DateTime('today +15 days');
        $this->assertEquals($comparisonTime->format('c'), $processed['properties']['startsOn']);
    }
}
