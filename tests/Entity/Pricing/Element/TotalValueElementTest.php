<?php

use Vespolina\Entity\Pricing\Element\TotalValueElement;

class TotalValueElementTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $totalElement = new TotalValueElement();

        $this->assertEquals(20, $totalElement->add(10, 10));
    }

    public function testSubtract()
    {
        $totalElement = new TotalValueElement();

        $this->assertEquals(10, $totalElement->subtract(20, 10));
    }
    
    public function testDoProcess()
    {
        $totalElement = new TotalValueElement();

        $context = new \Vespolina\Entity\Pricing\PricingContext();
        $startingProcessed = array(
            'properties' => array(),
            'values' => array(
                'netValue' => 20,
                'discounts' => 10,
                'surcharge' => 2,
                'taxes' => 1,
            ),
        );
        $processed = $totalElement->process($context, $startingProcessed);

        $this->assertEquals(13, $processed['values']['totalValue'], 'the total should be net - discounts + surcharge + taxes');

        $startingProcessed = array(
            'properties' => array(),
            'values' => array(
                'netValue' => 20,
            ),
        );
        $processed = $totalElement->process($context, $startingProcessed);

        $this->assertEquals(20, $processed['values']['totalValue'], 'nothing passed in but netValue still processes');
    }
}
