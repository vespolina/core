<?php

use ImmersiveLabs\Pricing\Entity\Element\RecurringElement;

class RecurringElementTest extends \PHPUnit_Framework_TestCase
{
    public function testDoProcess()
    {
        $recurringElement = new RecurringElement();
        $recurringElement->setCycles(-1);
        $recurringElement->setInterval('month');
        $recurringElement->setRecurringCharge('30');

        $context = new \ImmersiveLabs\Pricing\Entity\PricingContext();
        $processed = $recurringElement->process($context, array());

        $this->assertEquals(new \DateTime('today +1 month'), $processed['startsOn']);

        $recurringElement->setStartsIn('15 days');
        $processed = $recurringElement->process($context, array());
        $this->assertEquals(new \DateTime('today +15 days'), $processed['startsOn']);
    }
}
