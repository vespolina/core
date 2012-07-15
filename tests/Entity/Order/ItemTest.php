<?php

use Vespolina\Entity\Order\Item;
use Vespolina\Entity\Product;

/**
 * @author Richard Shank <develop@zestic.com>
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
        $product = $this->getMock('Vespolina\Entity\Product');
        $product->expects($this->atLeastOnce())
            ->method('validateOptions')
            ->will($this->returnValue($returns));

        return $product;
    }

    protected function createProductOptionValidate()
    {
        $product = $this->getMock('Vespolina\Entity\Product');
        $product->expects($this->atLeastOnce())
            ->method('validateOptions')
            ->will($this->returnValue(true));

        return $product;
    }
}
