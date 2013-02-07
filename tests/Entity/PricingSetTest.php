<?php

use ImmersiveLabs\Pricing\Entity\PricingElement;
use ImmersiveLabs\Pricing\Entity\PricingSet;

class PricingSetTest extends \PHPUnit_Framework_TestCase
{
    public function testAddPricingElements()
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

    public function testPlus()
    {
        $pricingSet1 = new PricingSet();
        $pricingSet1->set('discounts', 5);
        $pricingSet1->set('netValue', 5);
        $pricingSet1->set('surcharge', 5);
        $pricingSet1->set('taxes', 5);
        $pricingSet1->set('totalValue', 5);
        $pricingSet1->setProcessingState(PricingSet::PROCESSING_FINISHED);

        $sumPricingSet = $pricingSet1->plus(null);
        $this->assertInstanceOf('Vespolina\Entity\Pricing\PricingSetInterface', $sumPricingSet, 'a pricing set should be returned when nothing is added');
        $this->assertNotSame($pricingSet1, $sumPricingSet, 'the new set should be a new object');
        $this->assertEquals('5', $sumPricingSet->get('discounts'), 'the final value should be 10');
        $this->assertEquals('5', $sumPricingSet->get('netValue'), 'the final value should be 10');
        $this->assertEquals('5', $sumPricingSet->get('surcharge'), 'the final value should be 10');
        $this->assertEquals('5', $sumPricingSet->get('taxes'), 'the final value should be 10');
        $this->assertEquals('5', $sumPricingSet->get('totalValue'), 'the final value should be 10');

        $pricingSet2 = new PricingSet();
        $pricingSet2->set('discounts', 5);
        $pricingSet2->set('netValue', 5);
        $pricingSet2->set('surcharge', 5);
        $pricingSet2->set('taxes', 5);
        $pricingSet2->set('totalValue', 5);
        $pricingSet2->setProcessingState(PricingSet::PROCESSING_FINISHED);

        $sumPricingSet = $pricingSet1->plus($pricingSet2);
        $this->assertInstanceOf('Vespolina\Entity\Pricing\PricingSetInterface', $sumPricingSet, 'a pricing set should be returned');
        $this->assertNotSame($pricingSet1, $sumPricingSet, 'the new set should be a new object');
        $this->assertNotSame($pricingSet2, $sumPricingSet, 'the new set should be a new object');
        $this->assertEquals('10', $sumPricingSet->get('discounts'), 'the final value should be 10');
        $this->assertEquals('10', $sumPricingSet->get('netValue'), 'the final value should be 10');
        $this->assertEquals('10', $sumPricingSet->get('surcharge'), 'the final value should be 10');
        $this->assertEquals('10', $sumPricingSet->get('taxes'), 'the final value should be 10');
        $this->assertEquals('10', $sumPricingSet->get('totalValue'), 'the final value should be 10');

        $pricingSet1 = new PricingSet();
        $pricingSet1->set('scalar', 5);
        $pricingSet1->set('object', new PricingSet());
        $pricingSet1->setProcessingState(PricingSet::PROCESSING_FINISHED);
        $sumPricingSet = $pricingSet1->plus(null);
        $this->assertInstanceOf('Vespolina\Entity\Pricing\PricingSetInterface', $sumPricingSet, 'a pricing set should be returned when nothing is added');
        $this->assertNotSame($pricingSet1, $sumPricingSet, 'the new set should be a new object');
        $this->assertEquals('5', $sumPricingSet->get('scalar'), 'a scalar value is set');
        $this->assertNull($sumPricingSet->get('object'), 'a non scalar is skipped');

        $this->markTestIncomplete('implement combining mismatched processed elements');
        $this->markTestIncomplete('implement inclusions/exclusions from adding process by passing array (either white or black list?)');
    }
}
