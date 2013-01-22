<?php

use Pricing\Entity\PricingElement;
use Pricing\Entity\PricingSet;

class PricingSetTest extends \PHPUnit_Framework_TestCase
{
    public function testAddElements()
    {
        $pricingSet = new PricingSet();

        $this->assertCount(1, $pricingSet->getElements(), 'the elements should start with the total value element');

        $element1 = new PricingElement();
        $element1->setPosition(100);
        $pricingSet->addElement($element1);
        $this->assertCount(2, $pricingSet->getElements());

        $element2 = new PricingElement();
        $element2->setPosition(10);
        $pricingSet->addElement($element2);
        $elements = $pricingSet->getElements();
        $this->assertCount(3, $elements);
        $this->assertSame($element2, $elements[0], 'the second element should be first since the position is lower');
        $this->assertSame($element1, $elements[1], 'the first element should be next since the position is higher');
        $this->assertInstanceOf('', $elements[2], 'the preset element should be last');


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
