<?php

use Vespolina\Entity\Order\Item;
/**
 * @author Richard Shank <develop@zestic.com>
 */
class ItemTest extends \PHPUnit_Framework_TestCase
{
    public function testOptionMethods()
    {
        $item = new Item();

        $rmSetProduct = new \ReflectionMethod($item, 'setProduct');
        $rmSetProduct->setAccessible(true);
        $rmSetProduct->invokeArgs($item, array($this->createProductOptionValidate()));

        $this->assertNull($item->getOption('noOption'));

        $rmAddOption = new \ReflectionMethod($item, 'addOption');
        $rmAddOption->setAccessible(true);
        $rmAddOption->invokeArgs($item, array('option1', 1));
        $this->assertCount(1, $item->getOptions());
        $this->assertSame(1, $item->getOption('option1'));

        $rmAddOption->invokeArgs($item, array('option2', 2));
        $this->assertCount(2, $item->getOptions());
        $this->assertSame(2, $item->getOption('option2'));

        $rmRemoveOption = new \ReflectionMethod($item, 'removeOption');
        $rmRemoveOption->setAccessible(true);
        $rmRemoveOption->invoke($item, 'option2');
        $this->assertCount(1, $item->getOptions(), 'remove by option');
        $this->assertNull($item->getOption('option2'));

        $options = array(
            'option2' => 2,
            'option3' => 3
        );

        $rmAddOptions = new \ReflectionMethod($item, 'addOptions');
        $rmAddOptions->setAccessible(true);
        $rmAddOptions->invoke($item, $options);
        $this->assertCount(3, $item->getOptions());
        $this->assertSame(2, $item->getOption('option2'));
        $this->assertSame(3, $item->getOption('option3'));

        $rmSetOptions = new \ReflectionMethod($item, 'setOptions');
        $rmSetOptions->setAccessible(true);
        $rmSetOptions->invoke($item, $options);
        $this->assertCount(2, $item->getOptions());
        $this->assertNull($item->getOption('option1'));
        $this->assertSame(2, $item->getOption('option2'));
        $this->assertSame(3, $item->getOption('option3'));

        $rmRemoveOption->invoke($item, 'option3');
        $this->assertCount(1, $item->getOptions(), 'option should be removed by type');

        $rmRemoveOption->invoke($item, 'nada');
        $this->assertCount(1, $item->getOptions());

        $rmClearOptions = new \ReflectionMethod($item, 'clearOptions');
        $rmClearOptions->setAccessible(true);
        $rmClearOptions->invoke($item);
        $this->assertEmpty($item->getOptions());
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
