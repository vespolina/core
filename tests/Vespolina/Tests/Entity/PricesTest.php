<?php

namespace Vespolina\Tests\Entity;

use Vespolina\Entity\Order\Order;
use Vespolina\Entity\Product\Product;
use Vespolina\Entity\Item;

class PricesTest extends \PHPUnit_Framework_TestCase
{
    public function testPrices()
    {
        $this->pricesAssertions(new Item(), 'unit');
        $this->pricesAssertions(new Order(), 'total');
        $this->pricesAssertions(new Product(), 'unit');
    }
    
    protected function pricesAssertions($obj, $default)
    {
        $this->assertNull($obj->getPrice('does_not_exist'), 'a non existent price type should return null');

        $this->assertSame(0, $obj->getPrice(), 'the unit price should start out as 0');
        $obj->setPrice(35);
        $this->assertSame(35, $obj->getPrice($default), 'the unit should have been set');
        $this->assertSame(35, $obj->getPrice(), 'if no type is set, the unit should be returned');
        $obj->setPrice(105, 'something special');
        $this->assertSame(35, $obj->getPrice(), 'the unit price should not have been change');
        $this->assertSame(35, $obj->getPrice($default), 'the unit price should not have been change');
        $this->assertSame(105, $obj->getPrice('something special'), 'the specific type should be returned');
        $expected = [
            0 => [
                'type' => $default,
                'value' => 35,
            ],
            1 => [
                'type' => 'something special',
                'value' => 105,
            ],
        ];
        $this->assertSame($expected, $obj->getPrices());
        $data = [
            0 => [
                'type' => 'cost',
                'value' => 30,
            ],
        ];
        $obj->mergePrices($data);
        $expected = [
            0 => [
                'type' => $default,
                'value' => 35,
            ],
            1 => [
                'type' => 'something special',
                'value' => 105,
            ],
            2 => [
                'type' => 'cost',
                'value' => 30,
            ],
        ];
        $this->assertSame($expected, $obj->getPrices(), 'the data should be merged');
        $data = [
            0 => [
                'type' => $default,
                'value' => 40,
            ],
            1 => [
                'type' => 'retail',
                'value' => 65,
            ],
        ];
        $obj->setPrices($data);
        $this->assertSame($data, $obj->getPrices(), 'the data should be set and old data overwritten');
    }
}
 