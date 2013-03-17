<?php

use Vespolina\Entity\Pricing\Element\TotalDoughValueElement;

class TotalDoughValueElementTest extends \PHPUnit_Framework_TestCase
{
    public function testDoProcess()
    {
        $recurringElement = new TotalDoughValueElement();


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
