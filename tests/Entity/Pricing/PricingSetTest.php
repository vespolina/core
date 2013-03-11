<?php

use Vespolina\Entity\Pricing\PricingElement;
use Vespolina\Entity\Pricing\PricingSet;

class PricingSetTest extends \PHPUnit_Framework_TestCase
{
    public function testAddElements()
    {
        $pricingSet = new PricingSet();
        $rp = new \ReflectionProperty($pricingSet, 'pricingElements');
        $rp->setAccessible(true);
        $rp->setValue($pricingSet, null);

        $element1 = new PricingElement();
        $pricingSet->addPricingElement($element1);
        $this->assertCount(1, $pricingSet->getPricingElements());
        $this->assertSame($pricingSet, $element1->getPricingSet());

        $element2 = new PricingElement();
        $pricingSet->addPricingElement($element2);
        $this->assertCount(2, $pricingSet->getPricingElements());

        $elements[] = new PricingElement();
        $elements[] = new PricingElement();
        $pricingSet->addPricingElements($elements);
        $this->assertCount(4, $pricingSet->getPricingElements());
    }

    public function testGet()
    {
        $pricingSet = new PricingSet();
        $object = new stdClass();
        $pricingSet->setProcessedProperties(array('thisPropertyExists' => 10));
        $pricingSet->setProcessedValues(array('thisValueExists' => $object));
        $pricingSet->setProcessingState(PricingSet::PROCESSING_FINISHED);
        $this->assertNull($pricingSet->get('noWayInHellThisExists'));

        $this->assertEquals(10, $pricingSet->get('thisPropertyExists'));
        $this->assertEquals($object, $pricingSet->get('thisValueExists'));
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

    public function testGetPricingElements()
    {
        $pricingSet = new PricingSet();
        $rp = new \ReflectionProperty($pricingSet, 'pricingElements');
        $rp->setAccessible(true);
        $rp->setValue($pricingSet, null);

        $element1 = new PricingElement();
        $element1->setPosition(100);
        $element2 = new PricingElement();
        $element2->setPosition(1000);
        $element3 = new PricingElement();
        $element4 = new PricingElement();
        $elements[] = $element1;
        $elements[] = $element2;
        $elements[] = $element3;
        $elements[] = $element4;
        $pricingSet->addPricingElements($elements);
        $pricingElements = $pricingSet->getPricingElements();
        $this->assertCount(4, $pricingElements);
        $this->assertArrayHasKey(0, $pricingElements);
        $this->assertArrayHasKey(1, $pricingElements);
        $this->assertArrayHasKey(100, $pricingElements);
        $this->assertArrayHasKey(1000, $pricingElements);
    }

    public function testProcess()
    {
        $pricingSet = new PricingSet();

        $elementNetValue = $this->getMock('Vespolina\Entity\Pricing\PricingElement', array('process'));
        $elementNetValue->expects($this->any())
            ->method('process')
            ->will($this->returnValue(array('netValue' => '9.99')));
        $elementDiscount = $this->getMock('Vespolina\Entity\Pricing\PricingElement', array('process'));
        $elementDiscount->expects($this->any())
            ->method('process')
            ->will($this->returnValue(array('discount' => '.99')));

        $this->markTestIncomplete(
            'Pricing processing needs better a better test'
        );
        $pricingSet->process();

        $this->assertEqual('9.99', $pricingSet->getNetValue(), 'the final value should be 9.99');
        $this->assertEqual('.99', $pricingSet->getDiscount(), 'the final value should be .99');
        $this->assertEqual('9.00', $pricingSet->getValue(), 'the final value should be 9.00');

        $this->markTestIncomplete('test all default returns');
        $this->markTestIncomplete('test custom returns');
    }
}
