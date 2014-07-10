<?php

namespace Vespolina\Tests\Entity\Product;

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Product\Option;
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

        $this->assertFalse($product1->equals($product2));
    }

    public function testOptions()
    {
        $product = new Product();

        $product->setOption('color', 'colorBlue', 'Blue', 'blue');
        $product->setOption('color', 'colorGreen', 'Green', 'green');
        $product->setOption('color', 'colorRed', 'Red', 'red');

        $product->setOption('material', 'materialCotton', 'Cotton', 'cotton');
        $product->setOption('material', 'materialSmall', 'Polyester', 'polyester');

        $product->setOption('size', 'sizeLarge', 'Large', 'large');
        $product->setOption('size', 'sizeSmall', 'Small', 'small');

        $options = $product->getOptions();
        $this->assertCount(7, $options, 'all product options should be returned');
        $options = $product->getOptions('color');
        $this->assertCount(3, $options, 'all product options of color type should be returned');
        $this->assertInstanceOf('Vespolina\Entity\Product\Option', array_shift($options), 'a Option object should be returned');

        $blue = $product->getOption('color', 'colorBlue');
        $this->assertInstanceOf('Vespolina\Entity\Product\Option', $blue, 'the single option object should have been returned');

        $options = $product->getOptionsArray();
        $expected = [
            'color' => [
                'colorBlue' => 'Blue',
                'colorGreen' => 'Green',
                'colorRed' => 'Red',
            ],
            'material' => [
                'materialCotton' => 'Cotton',
                'materialSmall' => 'Polyester',
            ],
            'size' => [
                'sizeLarge' => 'Large',
                'sizeSmall' => 'Small',
            ],
        ];

        $this->assertEquals($expected, $options, 'all product options should be returned');
        $options = $product->getOptionsArray('size');
        $expected = [
            'sizeLarge' => 'Large',
            'sizeSmall' => 'Small',
        ];
        $this->assertEquals($expected, $options, 'all product options of size type should be returned');


        $product->setOption('color', 'colorBlue', 'NewBlue', 'newblue');
        $newBlue = $product->getOption('color', 'colorBlue');
        $this->assertSame('NewBlue', $newBlue->getDisplay(), 'the display should have changed');
        $this->assertSame('newblue', $newBlue->getName(), 'the display should have changed');
        $this->assertSame(spl_object_hash($blue), spl_object_hash($newBlue), 'the object should be the same');

        return $product;
    }

    /**
     * @depends testOptions
     */
    public function testSetOptionsInVariation($product)
    {
        $variation = $product->useVariation('variant1');
        $variation->setOption('materialCotton', 'materialCotton', 'Cotton', 'cotton');
        $options = $variation->getOptions();
        $this->assertCount(1, $options, 'the product variation should only return the options set for it');

        $variation->setOption('size', 'sizeSmall');
        $productOption = $product->getOption('size', 'sizeSmall');
        $variationOption = $product->getOption('size', 'sizeSmall');
        $this->assertEquals($productOption, $variationOption, 'a partial product variation should match the parent option');

        $variation->setOption('color', 'colorBlue', 'Blue', 'blue');
        $option = $product->getOption('color', 'colorBlue');
        $this->assertSame('blue', $option->getName(), 'the change in values should be reflected in the parent');
        $this->assertSame('Blue', $option->getDisplay(), 'the change in values should be reflected in the parent');

        $productOption = $product->getOption('size', 'sizeMedium');
        $variationOption = $product->getOption('size', 'sizeMedium');
        $this->assertEquals($productOption, $variationOption, 'a partial product variation should match the parent option');
    }
}
