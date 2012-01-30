<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\CartBundle\Tests\Model;

use Symfony\Bundle\DoctrineMongoDBBundle\Tests\TestCase;

use Vespolina\CartBundle\Tests\Fixtures\Document\Cartable;
use Vespolina\CartBundle\Tests\CartTestCommon;

/**
 * @author Richard D Shank <develop@zestic.com>
 */
class CartItemTest extends CartTestCommon
{
    public function testTotalCartItems()
    {
        $cartable1 = $this->createCartableItem('cartable1', 1);
        $item = $this->createCartItem($cartable1);
        $this->assertSame(1, $item->getTotalPrice(), 'the price should be set cart item');

        $item->setQuantity(3);
        $this->assertSame(3, $item->getTotalPrice(), 'the price should change with a change in quantity');
    }
}
