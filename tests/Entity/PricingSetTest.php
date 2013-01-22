<?php

use Pricing\Entity\PricingElement;
use Pricing\Entity\PricingSet;

class PricingSetTest extends \PHPUnit_Framework_TestCase
{
    public function testAddElements()
    {
        $pricingSet = new PricingSet();

        $this->assertNull($pricingSet->getElements(), 'the elements should start empty');

        $element1 = new PricingElement();
        $pricingSet->addElement($element1);
        $this->assertCount(1, $pricingSet->getElements());

        $element2 = new PricingElement();
        $pricingSet->addElement($element2);
        $this->assertCount(2, $pricingSet->getElements());
    }

    public function testProcess()
    {
        $pricingSet = new PricingSet();

        $elementNetValue = $this->getMock('Vespolina\Entity\Pricing\PricingElement', array('process'));
        $elementNetValue->expects($this->any())
            ->method('process')
            ->will($this->returnValue(array('netValue' => '9.99')));

        $pricingSet->process();

        $this->assertEqual('9.99', $pricingSet->getNetValue(), 'the final value should be 9.99');
        $this->assertEqual('9.99', $pricingSet->getValue(), 'the final value should be 9.00');

    }
}
