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
            'quantity' => 1
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
        $this->assertSame('nothing', $context->get('something', 'something'), 'the default should only happen when there is no data'); // todo: this may need to change
    }

    public function testSetQuantity()
    {
        $context = new PricingContext();

        $context->setQuantity(3);

        $this->assertSame(3, $context->get('quantity'), "since this is a shortcut for set('quantity', 3) the get('quantity') should return the correct value");
        $this->assertSame(3, $context->getQuantity(), 'the quantity that was set should be returned');
    }

    public function testGetQuantity()
    {
        $context = new PricingContext();

        $this->assertSame(1, $context->getQuantity(), 'when the quantity has not been set, it should default to 1');
        $this->assertSame(1, $context->get('quantity'), 'when the quantity has not been set, it should default to 1');

        $context->setQuantity(4);
        $this->assertSame(4, $context->getQuantity(), 'the quantity that was set by the setQuantity() method should be returned');
        $context->set('quantity', 5);
        $this->assertSame(5, $context->getQuantity(), 'the quantity that was set by the set() method should be returned');
    }
}
