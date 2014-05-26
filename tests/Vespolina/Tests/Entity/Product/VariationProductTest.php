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
    public function testOptions()
    {
        $product = new Product();

        $colorGroup = new OptionGroup();
        $colorBlue = $this->createOption('Blue', 'blue', 'color', 'colorBlue');
        $colorGreen = $this->createOption('Green', 'green', 'color', 'colorGreen');
        $colorRed = $this->createOption('Red', 'red', 'color', 'colorRed');
        $colorGroup->addOption($colorBlue);
        $colorGroup->addOption($colorGreen);
        $colorGroup->addOption($colorRed);

        $materialGroup = new OptionGroup();
        $materialCotton = $this->createOption('Cotton', 'cotton', 'material', 'materialCotton');
        $materialSmall = $this->createOption('Polyester', 'polyester', 'material', 'materialSmall');
        $materialGroup->addOption($materialCotton);
        $materialGroup->addOption($materialSmall);

        $sizeGroup = new OptionGroup();
        $sizeLarge = $this->createOption('Large', 'large', 'size', 'sizeLarge');
        $sizeSmall = $this->createOption('Small', 'small', 'size', 'sizeSmall');
        $sizeGroup->addOption($sizeLarge);
        $sizeGroup->addOption($sizeSmall);
    }

    public function testVariations()
    {
        $product = new Product();

        $this->assertFalse($product->hasVariations(), 'there should not be any variations when initialized');
        $this->assertEmpty($product->getVariations(), 'there should not be any variations when initialized');

        $product->setPrice(3);
        $product->useVariation('variant1')->setPrice(4);
        $product->useVariation('variant2')->setPrice(7);
        $this->assertSame(3, $product->getPrice());
        $this->assertSame(4, $product->useVariation('variant1')->getPrice());
        $this->assertSame(7, $product->useVariation('variant2')->getPrice());

        $this->assertTrue($product->hasVariations());
        $variations = $product->getVariations();
        $this->assertCount(2, $variations);
        $this->assertInstanceof('Vespolina\Entity\Product\Product', $variations['variant1']);
    }

    protected function createProduct()
    {
        $options = [
            'screwSize' => [
                [
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
                ]
            ],
            'color' => [
                [
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
                ]
            ],
            'material' => [
                [
                    'plastic' => [
                        'Plastic', 'Plastic',
                    ],
                    'metal' => [
                        'Metal', 'Metal',
                    ],
                ]
            ],
        ];

        $product = new Product();
        foreach ($options as $type => $typeOption) {
            foreach ($typeOption as $index => $data) {
                $product->addOption($this->createOption($data[0], $data[1], $type, $index));
            }
        }

        $data = [
            'screwSize' => [
                'M6' => [
                    'material' => [
                        'metal',
                    ],
                    'color' => [
                        'black'
                    ],
                ],
                'M6' => [
                    'material' => [
                        'metal',
                    ],
                    'color' => [
                        'blue',
                    ],
                ],
                'M6' => [
                    'material' => [
                        'metal',
                    ],
                    'color' => [
                        'green',
                    ],
                ],
                'M10' => [
                    'material' => [
                        'metal',
                    ],
                    'color' => [
                        'black'
                    ],
                ],
                'M10' => [
                    'material' => [
                        'metal',
                    ],
                    'color' => [
                        'gold',
                    ],
                ],
                'M10' => [
                    'material' => [
                        'metal',
                    ],
                    'color' => [
                        'green',
                    ],
                ],
            ],
        ];
        $product = new VariationProduct();


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
