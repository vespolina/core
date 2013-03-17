<?php

use Vespolina\Entity\Pricing\Element\TotalDoughValueElement;
use Dough\Money\Money;

class TotalDoughValueElementTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $totalElement = new TotalDoughValueElement();

        $this->assertEquals(new Money(20), $totalElement->add(new Money(10), new Money(10)));
    }

    public function testSubtract()
    {
        $totalElement = new TotalDoughValueElement();

        $this->assertEquals(new Money(10), $totalElement->subtract(new Money(20), new Money(10)));
    }

    public function testDoProcess()
    {
        $totalElement = new TotalDoughValueElement();

        $context = new \Vespolina\Entity\Pricing\PricingContext();
        $startingProcessed = array(
            'properties' => array(),
            'values' => array(
                'netValue' => new Money(20),
                'discounts' => new Money(10),
                'surcharge' => new Money(2),
                'taxes' => new Money(1),
            ),
        );
        $processed = $totalElement->process($context, $startingProcessed);

        $this->assertEquals(new Money(13), $processed['values']['totalValue'], 'the total should be net - discounts + surcharge + taxes');

        $startingProcessed = array(
            'properties' => array(),
            'values' => array(
                'netValue' => new Money(20),
            ),
        );
        $processed = $totalElement->process($context, $startingProcessed);

        $this->assertEquals(new Money(20), $processed['values']['totalValue'], 'nothing passed in but netValue still processes');
    }
}
