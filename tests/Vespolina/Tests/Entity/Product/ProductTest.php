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

        $colorBlue = $this->createOption('Blue', 'blue', 'color', 'colorBlue');
        $colorGreen = $this->createOption('Green', 'green', 'color', 'colorGreen');
        $colorRed = $this->createOption('Red', 'red', 'color', 'colorRed');
        $product->addOption($colorBlue);
        $product->addOption($colorGreen);
        $product->addOption($colorRed);

        $materialCotton = $this->createOption('Cotton', 'cotton', 'material', 'materialCotton');
        $materialSmall = $this->createOption('Polyester', 'polyester', 'material', 'materialSmall');
        $product->addOption($materialCotton);
        $product->addOption($materialSmall);

        $sizeLarge = $this->createOption('Large', 'large', 'size', 'sizeLarge');
        $sizeSmall = $this->createOption('Small', 'small', 'size', 'sizeSmall');
        $product->addOption($sizeLarge);
        $product->addOption($sizeSmall);

        $options = $product->getOptions();
        $this->assertCount(7, $options, 'all product options should be returned');
        $options = $product->getOptions('color');
        $this->assertCount(3, $options, 'all product options of color type should be returned');
        $this->assertInstanceOf('Vespolina\Entity\Product\Option', array_shift($options), 'a Option object should be returned');

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
    }

    protected function createOption($display, $name, $type, $index)
    {
        $option = new Option();

        $option->setDisplay($display);
        $option->setIndex($index);
        $option->setName($name);
        $option->setType($type);

        return $option;
    }
}
