<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\CartBundle\Tests\Document;

use Doctrine\Bundle\MongoDBBundle\Tests\TestCase;

use Vespolina\CartBundle\Document\CartManager;
use Vespolina\CartBundle\Tests\CartTestCommon;
use Vespolina\CartBundle\Tests\Fixtures\Document\Cartable;

/**
 * @author Richard D Shank <develop@zestic.com>
 */
class CartManagerTest extends TestCase
{
    protected $cartMgr;

    public function testAddItemToCart()
    {
        $cart = $this->persistNewCart();
        $cartable = $this->persistNewCartable('product');
        $this->cartMgr->addItemToCart($cart, $cartable);

        $items = $cart->getItems();
        $this->assertSame(1, $items->count());
        $item = $items->current();
        $this->assertSame($cartable, $item->getCartableItem());
    }

    public function setup()
    {

        $pricingProvider = new \Vespolina\CartBundle\Pricing\SimpleCartPricingProvider();
        $pricingProvider->addCartHandler(new \Vespolina\CartBundle\Handler\DefaultCartHandler());

        $this->dm = self::createTestDocumentManager();
        $this->cartMgr = new CartManager(
            $this->dm,
            $pricingProvider,
            '\Vespolina\CartBundle\Tests\Fixtures\Document\Cart',
            '\Vespolina\CartBundle\Tests\Fixtures\Document\CartItem'
        );
    }

    public function tearDown()
    {
        $collections = $this->dm->getDocumentCollections();
        foreach ($collections as $collection) {
            $collection->drop();
        }
    }

    protected function persistNewCart($name = null)
    {
        $cart = $this->cartMgr->createCart($name);
        $this->cartMgr->updateCart($cart);

        return $cart;
    }

    protected function persistNewCartable($name)
    {
        $cartable = new Cartable();
        $cartable->setName($name);
        $this->dm->persist($cartable);
        $this->dm->flush();
        return $cartable;
    }
}
