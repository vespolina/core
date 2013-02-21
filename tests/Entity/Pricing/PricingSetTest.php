<?php

use Vespolina\Entity\Pricing\PricingElement;
use Vespolina\Entity\Pricing\PricingSet;

class PricingSetTest extends \PHPUnit_Framework_TestCase
{
    public function testAddElements()
    {
        $pricingSet = new PricingSet();
        $pricingElementsCount = count($pricingSet->getPricingElements());

        $this->assertGreaterThan(0, $pricingElementsCount, 'there should be at least one default element');

        $element1 = new PricingElement();   
        $pricingSet->addPricingElement($element1);
        $pricingElementsCount++;
        $this->assertEquals($pricingElementsCount, count($pricingSet->getPricingElements()));

        $element2 = new PricingElement();
        $pricingSet->addPricingElement($element2);
        $this->assertEquals($pricingElementsCount, count($pricingSet->getPricingElements()), 'should be still two');
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
            'Pricing processingneeds better a better test'
        );
        $pricingSet->process();

        $this->assertEqual('9.99', $pricingSet->getNetValue(), 'the final value should be 9.99');
        $this->assertEqual('.99', $pricingSet->getDiscount(), 'the final value should be .99');
        $this->assertEqual('9.00', $pricingSet->getValue(), 'the final value should be 9.00');

        $this->markTestIncomplete('test all default returns');
        $this->markTestIncomplete('test custom returns');
    }
}
