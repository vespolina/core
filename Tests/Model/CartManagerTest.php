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
class CartManagerTest extends CartTestCommon
{
    private $cartMgr;

    public function testSetCartState()
    {
        $cart = $this->createCart();

        $this->cartMgr->setCartState($cart, 'open');
        $this->assertSame('open', $cart->getState());

        $this->cartMgr->setCartState($cart, 'close');
        $this->assertSame('close', $cart->getState());
    }

    public function setup()
    {
        $this->cartMgr = $this->getMockForAbstractClass('\Vespolina\CartBundle\Model\CartManager', array(), '', false);
    }
}
