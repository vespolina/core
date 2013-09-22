<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Order\Item;
use Vespolina\Entity\Product\Product;

/**
 * @author Richard Shank <richard@vespolina.org>
 */
class ItemTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $item = new Item();
        $this->assertNull($item->getProduct(), 'its ok if no product is passed in');

        $product = new Product();
        $item = new Item($product);
        $this->assertSame($product, $item->getProduct(), 'the construct should set the product, if its passed in');
    }

    public function testAttributeMethods()
    {
        $item = new Item();

        $this->assertNull($item->getAttribute('noAttribute'));

        $item->addAttribute('attribute1', 1);
        $this->assertCount(1, $item->getAttributes());
        $this->assertSame(1, $item->getAttribute('attribute1'));

        $item->addAttribute('attribute2', 2);
        $this->assertCount(2, $item->getAttributes());
        $this->assertSame(2, $item->getAttribute('attribute2'));

        $item->removeAttribute('attribute2');
        $this->assertCount(1, $item->getAttributes(), 'remove by attribute');
        $this->assertNull($item->getAttribute('attribute2'));

        $attributes = array(
            'attribute2' => 2,
            'attribute3' => 3
        );

        $item->addAttributes($attributes);
        $this->assertCount(3, $item->getAttributes());
        $this->assertSame(2, $item->getAttribute('attribute2'));
        $this->assertSame(3, $item->getAttribute('attribute3'));

        $item->setAttributes($attributes);
        $this->assertCount(2, $item->getAttributes());
        $this->assertNull($item->getAttribute('attribute1'));
        $this->assertSame(2, $item->getAttribute('attribute2'));
        $this->assertSame(3, $item->getAttribute('attribute3'));

        $item->removeAttribute('attribute3');
        $this->assertCount(1, $item->getAttributes(), 'attribute should be removed by type');
        $item->removeAttribute('nada');
        $this->assertCount(1, $item->getAttributes());

        $item->clearAttributes();
        $this->assertEmpty($item->getAttributes());
    }

    public function testOptionMethods()
    {
        $item = new Item();

        $rmSetProduct = new \ReflectionMethod($item, 'setProduct');
        $rmSetProduct->setAccessible(true);

        $this->assertNull($item->getOption('noOption'));

        $rmSetOptions = new \ReflectionMethod($item, 'setOptions');
        $rmSetOptions->setAccessible(true);

        $rmSetProduct->invokeArgs($item, array($this->createProductOptionValidate()));
        $rmSetOptions->invoke($item, array(
            'option2' => 2,
            'option3' => 3
        ));

        $options = $item->getOptions();
        $this->assertCount(2, $options);
        $this->assertArrayHasKey('option2', $options);
        $this->assertArrayHasKey('option3', $options);

        $rmClearOptions = new \ReflectionMethod($item, 'clearOptions');
        $rmClearOptions->setAccessible(true);

        $rmSetProduct->invokeArgs($item, array($this->createProductOptionValidate(false)));
        $this->setExpectedException('Vespolina\Exception\InvalidOptionsException');
        $rmClearOptions->invoke($item);
        $this->assertSame($options, $item->getOptions(), 'nothing should have been removed if the validation fails');

        $rmSetProduct->invokeArgs($item, array($this->createProductOptionValidate()));
        $rmClearOptions->invoke($item);
        $this->assertEmpty($item->getOptions());

        $rmSetProduct->invokeArgs($item, array($this->createProductOptionValidate(false)));
        $this->setExpectedException('Vespolina\Exception\InvalidOptionsException');
        $rmSetOptions->invokeArgs($item, array('failure' => 0));
        $this->assertEmpty($item->getOptions(), 'nothing should be added if the validation fails');
    }

    protected function createProductOptionValidate($returns = true)
    {
        $product = $this->getMock('Vespolina\Entity\Product\Product');
        $product->expects($this->atLeastOnce())
            ->method('validateOptions')
            ->will($this->returnValue($returns));

        return $product;
    }
}
