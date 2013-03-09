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
