<?php

use Vespolina\Entity\Pricing\PricingContext;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class PricingContextTest extends \PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $data = array(
            'something' => 'nothing',
        );
        $context = new PricingContext($data);

        $this->assertSame('nothing', $context['something'], 'simple return of data');
    }
}
