<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Tests\Entity\Product;

use Vespolina\Entity\Brand\Brand;
use Vespolina\Entity\Product\Attribute;
use Vespolina\Entity\Product\Option;
use Vespolina\Entity\Product\OptionGroup;
use Vespolina\Entity\Product\Product;
use Vespolina\Entity\Identifier\SKUIdentifier;
use Vespolina\Media\Entity\Asset;
use Vespolina\Media\Entity\Media;

class VariationProductTest extends \PHPUnit_Framework_TestCase
{
    public function testVariations()
    {
        $product = new Product();

        $this->assertFalse($product->hasVariations(), 'there should not be any variations when initialized');
        $this->assertEmpty($product->getVariations(), 'there should not be any variations when initialized');

        $product->setPrice(3);
        $variation = $product->useVariation('variant1')->setPrice(4);
        $this->assertSame($product, $variation->getParent(), 'the original Product class should be the variation parent');
        $product->useVariation('variant2')->setPrice(7);
        $this->assertSame(3, $product->getPrice());
        $this->assertSame(4, $product->useVariation('variant1')->getPrice());
        $this->assertSame(7, $product->useVariation('variant2')->getPrice());

        $this->assertTrue($product->hasVariations());
        $variations = $product->getVariations();
        $this->assertCount(2, $variations);
        $this->assertInstanceof('Vespolina\Entity\Product\Product', $variations['variant1']);

        // next goal is to be able to select a product variation and add it to the cart
    }

    public function testSelectVariationsByOption()
    {
        $product = $this->createVariationProduct();
    }

    protected function createVariationProduct()
    {
        $options = [
            'screwSize' => [
                'M6' => [
                    'M6', 'M6',
                ],
                'M8' => [
                    'M8', 'M8',
                ],
                'M10' => [
                    'M10', 'M10',
                ],
                'M12' => [
                    'M12', 'M12',
                ],
            ],
            'color' => [
                'black' => [
                    'BK', 'Black',
                ],
                'blue' => [
                    'BL', 'Blue',
                ],
                'gold' => [
                    'GO', 'Gold',
                ],
                'green' => [
                    'GR', 'Green',
                ],
                'red' => [
                    'RD', 'Red',
                ],
            ],
            'material' => [
                'plastic' => [
                    'Plastic', 'Plastic',
                ],
                'metal' => [
                    'Metal', 'Metal',
                ],
            ],
        ];

        $product = new Product();
        foreach ($options as $type => $typeOptions) {
            foreach ($typeOptions as $index => $data) {
                $product->setOption($type, $index, $data[0], $data[1]);
            }
        }

        $data = [
            [
                'M6' => [
                    'material' => 'metal',
                    'color' => 'black',
                ],
            ],
            [
                'M6' => [
                    'material' => 'metal',
                    'color' => 'blue',
                ],
            ],
            [
                'M6' => [
                    'material' => 'metal',
                    'color' => 'green',
                ],
            ],
            [
                'M10' => [
                    'material' => 'metal',
                    'color' => 'black',
                ],
            ],
            [
                'M10' => [
                    'material' => 'metal',
                    'color' => 'gold',
                ],
            ],
            [
                'M10' => [
                    'material' => 'metal',
                    'color' => 'green',
                ],
            ],
        ];
        foreach ($data as $options) {
            foreach ($options as $screwSize => $otherOptions) {
                $label = $screwSize;
                foreach ($otherOptions as $type => $name) {
                    $label .= $name;
                }
                $variation = $product->useVariation($label);
            }
            foreach ($options as $screwSize => $otherOptions) {
                $variation->setOption('screwSize', $screwSize);
                foreach ($otherOptions as $type => $index) {
                    $variation->setOption($type, $index);
                }
            }
        }
    }
}
