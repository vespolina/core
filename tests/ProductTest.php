<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Tests;

use Vespolina\Entity\Feature;
use Vespolina\Entity\Product;

class ProductTest extends \PHPUnit_Framework_TestCase
{
    public function testFeatureMethods()
    {
        $product = new Product();

        $feature1 = new Feature();
        $feature1->setType('feature1');
        $product->addFeature($feature1);
        $this->assertCount(1, $product->getFeatures());
        $this->assertSame($feature1, $product->getFeature('feature1'));

        $feature2 = new Feature();
        $feature2->setType('feature2');
        $product->addFeature($feature2);
        $this->assertCount(2, $product->getFeatures());
        $this->assertSame($feature2, $product->getFeature('feature2'));

        $product->removeFeature($feature2);
        $this->assertCount(1, $product->getFeatures(), 'remove by feature');
        $this->assertNull($product->getFeature('feature2'));

        $feature3 = new Feature();
        $feature3->setType('feature3');

        $features = array();
        $features[] = $feature2;
        $features[] = $feature3;

        $product->addFeatures($features);
        $this->assertCount(3, $product->getFeatures());
        $this->assertSame($feature2, $product->getFeature('feature2'));
        $this->assertSame($feature3, $product->getFeature('feature3'));

        $product->setFeatures($features);
        $this->assertCount(2, $product->getFeatures());
        $this->assertNull($product->getFeature('feature1'));
        $this->assertSame($feature2, $product->getFeature('feature2'));
        $this->assertSame($feature3, $product->getFeature('feature3'));


        $product->removeFeature('feature3');
        $this->assertCount(1, $product->getFeatures(), 'feature should be removed by type');
        $product->removeFeature('nada');
        $this->assertCount(1, $product->getFeatures());

        $product->clearFeatures();
        $this->assertEmpty($product->getFeatures());

    }
}
