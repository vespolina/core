<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Product\Product;

class ProductTest extends \PHPUnit_Framework_TestCase
{
    public function testEqualsMethod()
    {
        /** @var $product \Vespolina\Entity\Product\Product */
        $product1 = $this->getMockForAbstractClass('Vespolina\Entity\Product\Product');
        $product2 = $this->getMockForAbstractClass('Vespolina\Entity\Product\Product');

        $rp = new \ReflectionProperty($product1, 'id');
        $rp->setAccessible(true);
        $rp->setValue($product1, 12345);

        $rp = new \ReflectionProperty($product2, 'id');
        $rp->setAccessible(true);
        $rp->setValue($product2, 12345);


        $this->assertTrue($product1->equals($product2));

    }

    public function testNotEqualsMethod()
    {
        /** @var $product \Vespolina\Entity\Product\Product */
        $product1 = $this->getMockForAbstractClass('Vespolina\Entity\Product\Product');
        $product2 = $this->getMockForAbstractClass('Vespolina\Entity\Product\Product');

        $rp = new \ReflectionProperty($product1, 'id');
        $rp->setAccessible(true);
        $rp->setValue($product1, 12345);

        $rp = new \ReflectionProperty($product2, 'id');
        $rp->setAccessible(true);
        $rp->setValue($product2, 9876);


        $this->assertTrue(!$product1->equals($product2));

    }
}
