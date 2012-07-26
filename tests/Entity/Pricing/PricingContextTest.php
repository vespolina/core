<?php

use Vespolina\Entity\Pricing\PricingContext;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class PricingContextTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $data = array(
            'something' => 'nothing',
        );
        $context = new PricingContext($data);

        $rp = new \ReflectionProperty($context, 'data');
        $rp->setAccessible(true);
        $this->assertSame($data, $rp->getValue($context), "the passed data should be put in the object's data property");
    }

    public function testGet()
    {
        $data = array(
            'something' => 'nothing',
        );
        $context = new PricingContext($data);

        $this->assertSame('nothing', $context->get('something'), 'simple return of data');
        $this->assertNull($context->get('bullshit'), 'there is no bullshit so a null should be returned');
        $this->assertSame('Charlie Sheen', $context->get('winning', 'Charlie Sheen'), "the default value should be returned since there isn't a data set");
        $this->assertSame('nothing', $context->get('something', 'something'), 'the default should only happen when there is no data');
    }
}
