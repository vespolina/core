<?php

use ImmersiveLabs\Pricing\Entity\PricingElement;
use ImmersiveLabs\Pricing\Entity\PricingSet;

class PricingSetTest extends \PHPUnit_Framework_TestCase
{
    public function testAddElements()
    {
        $pricingSet = new PricingSet();

        $this->assertCount(1, $pricingSet->getPricingElements(), 'the elements should start with the total value element');

        $element1 = new PricingElement();
        $element1->setPosition(100);
        $pricingSet->addPricingElement($element1);
        $this->assertCount(2, $pricingSet->getPricingElements());

        $element2 = new PricingElement();
        $element2->setPosition(10);
        $pricingSet->addPricingElement($element2);
        $elements = $pricingSet->getPricingElements();
        $this->assertCount(3, $elements);
        $this->assertSame($element2, array_shift($elements), 'the second element should be first since the position is lower');
        $this->assertSame($element1, array_shift($elements), 'the first element should be next since the position is higher');
        $this->assertInstanceOf('ImmersiveLabs\Pricing\Entity\Element\TotalValueElement', array_shift($elements), 'the preset element should be last');

        $this->markTestIncomplete('deal with multiple elements with the same position');
    }

    public function testProcess()
    {
        $pricingSet = new PricingSet();

        $elementNetValue = $this->getMock('ImmersiveLabs\Pricing\Entity\PricingElement', array('process'));
        $elementNetValue->expects($this->any())
            ->method('process')
            ->will($this->returnValue(array('netValue' => '9.99')));
        $pricingSet->addPricingElement($elementNetValue);

        $newSet = $pricingSet->process();
        $this->assertInstanceOf('Vespolina\Entity\Pricing\PricingSetInterface', $newSet, 'a pricing set should be returned');
        $this->assertNotSame($newSet, $pricingSet, 'the new set should be a new object');
        $this->assertEquals('9.99', $newSet->getNetValue(), 'the final value should be 9.99');
        $this->assertEquals('9.99', $newSet->getTotalValue(), 'the final value should be 9.00');
    }

    public function testGet()
    {
        $pricingSet = new PricingSet();
        $pricingSet->setProcessed(array('thisExists' => 10));
        $pricingSet->setProcessingState(PricingSet::PROCESSING_FINISHED);
        $this->assertNull($pricingSet->get('noWayInHellThisExists'));

        $this->assertEquals(10, $pricingSet->get('thisExists'));
    }
}
