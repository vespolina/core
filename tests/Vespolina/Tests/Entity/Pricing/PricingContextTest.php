<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Pricing\PricingContext;

/**
 * @author Richard Shank <richard@vespolina.org>
 */
class PricingContextTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $values = array(
            'something' => 'nothing',
            'quantity' => 1
        );
        $context = new PricingContext($values);

        $this->markTestIncomplete(
            'Pricing constructor needs better a better test'
        );
        return;

        $rp = new \ReflectionProperty($context, 'values');
        $rp->setAccessible(true);

        $this->assertSame($values, $rp->getValue($context), "the passed data should be put in the object's data property");
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

    public function testSet()
    {
        $context = new PricingContext();

        $context->set('quantity', 3);

        $this->assertSame(3, $context->get('quantity'), 'the quantity that was set should be returned');
    }
}
