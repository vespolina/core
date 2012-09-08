<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Asset\Media;
use Vespolina\Entity\Product\Feature;
use Vespolina\Entity\Product\Option;
use Vespolina\Entity\Product\OptionGroup;
use Vespolina\Entity\Product\BaseProduct;
use Vespolina\Entity\Identifier\SKUIdentifier;

class BaseProductTest extends \PHPUnit_Framework_TestCase
{
    public function testFeatureMethods()
    {
        $product = $this->getMockForAbstractClass('Vespolina\Entity\Product\BaseProduct');

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

    public function testMedia()
    {
        $product = $this->getMockForAbstractClass('Vespolina\Entity\Product\BaseProduct');
        $this->assertNull($product->getAllMedia(), 'make sure we start out empty');

        $media = new Media();
        $product->addMedia($media);
        $this->assertContains($media, $product->getAllMedia());
        $this->assertCount(1, $product->getAllMedia());

        $medias = array();
        $medias[] = new Media();
        $medias[] = new Media();
        $product->addMediaCollection($medias);
        $this->assertCount(3, $product->getAllMedia());
        $this->assertContains($media, $product->getAllMedia());

        $product->removeMedia($media);
        $this->assertNotContains($media, $product->getAllMedia());
        $this->assertCount(2, $product->getAllMedia());

        $product->clearMedia();
        $this->assertEmpty($product->getAllMedia());

        $product->addMedia($media);
        $product->setMedia($medias);
        $this->assertNotContains($media, $product->getAllMedia(), 'this should have been removed on setting a new array of items');
        $this->assertCount(2, $product->getAllMedia());
    }

    public function testOptionMatrix()
    {
        $product = $this->getMockForAbstractClass('Vespolina\Entity\Product\BaseProduct');

        $colorGroup = new OptionGroup();
        $colorBlue = $this->createOption('blue', 'color', 'colorBlue');
        $colorGreen = $this->createOption('green', 'color', 'colorGreen');
        $colorRed = $this->createOption('red', 'color', 'colorRed');
        $colorGroup->addOption($colorBlue);
        $colorGroup->addOption($colorGreen);
        $colorGroup->addOption($colorRed);

        $materialGroup = new OptionGroup();
        $materialCotton = $this->createOption('cotton', 'material', 'materialCotton');
        $materialSmall = $this->createOption('polyester', 'material', 'materialSmall');
        $materialGroup->addOption($materialCotton);
        $materialGroup->addOption($materialSmall);

        $sizeGroup = new OptionGroup();
        $sizeLarge = $this->createOption('large', 'size', 'sizeLarge');
        $sizeSmall = $this->createOption('small', 'size', 'sizeSmall');
        $sizeGroup->addOption($sizeLarge);
        $sizeGroup->addOption($sizeSmall);


    }

    protected function createOption($display, $type, $value)
    {
        $option = new Option();

        $option->setType($type);
        $option->setDisplay($display);
        $option->setValue($value);

        return $option;
    }
}
