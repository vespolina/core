<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Asset\Asset;
use Vespolina\Entity\Product\Product;
use Vespolina\Entity\Product\Merchandise;
use Vespolina\Entity\Channel\WebStore;

class MerchandiseTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $product = $this->createProduct();
        $storeChannel = new WebStore();
        $merchandise = new Merchandise($product, $storeChannel);

        $this->assertSame($product, $merchandise->getProduct(), 'product should be set in merchandise');

        // product properties should be copied to merchandise
        $properties = get_class_vars('Vespolina\Entity\Product\BaseProduct');
        foreach ($properties as $property) {
            $function = 'get' . ucfirst($property);
            $this->assertSame($merchandise->$function(), $product->$function());
        }

        $this->assertSame($merchandise->getChannel(), $storeChannel);
    }

    public function testAsset()
    {
        $product = $this->createProduct();
        $merchandise = new Merchandise($product);
        $this->assertNull($merchandise->getAssets(), 'make sure we start out empty');

        $asset = new Asset();
        $merchandise->addAsset($asset);
        $this->assertContains($asset, $merchandise->getAssets());
        $this->assertCount(1, $merchandise->getAssets());

        $assets = array();
        $assets[] = new Asset();
        $assets[] = new Asset();
        $merchandise->addAssets($assets);
        $this->assertCount(3, $merchandise->getAssets());
        $this->assertContains($asset, $merchandise->getAssets());

        $merchandise->removeAsset($asset);
        $this->assertNotContains($asset, $merchandise->getAssets());
        $this->assertCount(2, $merchandise->getAssets());

        $merchandise->clearAssets();
        $this->assertEmpty($merchandise->getAssets());

        $merchandise->addAsset($asset);
        $merchandise->setAssets($assets);
        $this->assertNotContains($asset, $merchandise->getAssets(), 'this should have been removed on setting a new array of items');
        $this->assertCount(2, $merchandise->getAssets());
    }

    protected function createProduct()
    {
        $product = new Product();
        $rc = new \ReflectionClass($product);
        $properties = $rc->getProperties();
        $chars = range('a', 'z');
        foreach ($properties as $property) {
            $property->setAccessible(true);
            shuffle($chars);
            $parts = array_slice($chars, 0, 8);
            $property->setValue($product, implode('', $parts));
        }

        return $product;
    }
}
