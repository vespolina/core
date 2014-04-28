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
use Vespolina\Entity\Product\BaseProduct;
use Vespolina\Entity\Product\Product;
use Vespolina\Entity\Identifier\SKUIdentifier;
use Vespolina\Media\Entity\Asset;
use Vespolina\Media\Entity\Media;

class VariationProductTest extends \PHPUnit_Framework_TestCase
{
    public function testVariations()
    {
        $product = new VariationProduct();

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
        $this->assertInstanceof('VariationProduct', $variations['variant1']);
    }

    protected function createProduct()
    {
        $options = [
            'screwSize' => [
                [
                    ''
                ]
            ],
        ];
        $data = [
            'screwSize' => [
                'M6' => [
                    'material' => [
                        'plastic',
                        'metal',
                    ],
                    'color' => [
                        'black'
                    ]
                ]
            ],
        ];
        $product = new VariationProduct();


    }
}

class VariationProduct extends BaseProduct
{

}
