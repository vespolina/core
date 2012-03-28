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
use Vespolina\CartBundle\Pricing\SimpleCartPricingProvider;
use Vespolina\CartBundle\Tests\CartTestCommon;
use Vespolina\CartBundle\Tests\Fixtures\Document\Cart;
use Vespolina\CartBundle\Tests\Fixtures\Document\Cartable;
use Vespolina\CartBundle\Tests\Fixtures\Document\Person;

/**
 * @author Richard D Shank <develop@zestic.com>
 */
class CartManagerTest extends TestCase
{
    protected $cartMgr;

    public function testSetCartState()
    {
        $cart = $this->persistNewCart();

        $persistedCart = $this->cartMgr->findCartById($cart->getId());
        $this->assertSame(Cart::STATE_OPEN, $persistedCart->getState(), 'the cart should start in an open state');

        $this->cartMgr->setCartState($cart, 'close');
        $persistedCart = $this->cartMgr->findCartById($cart->getId());
// there is a bug in mongodb will put in PR
//        $this->assertSame('close', $persistedCart->getState());
    }

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

    public function testFindItemInCart()
    {
        $cart = $this->persistNewCart();
        $cartable = $this->persistNewCartable('product');
        $addedItem = $this->cartMgr->addItemToCart($cart, $cartable);

        $item = $this->cartMgr->findItemInCart($cart, $cartable);

        $this->assertSame($item, $addedItem);
    }

    public function testRemoveItemFromCart()
    {
        $cart = $this->persistNewCart();
        $cartable = $this->persistNewCartable('product');
        $this->cartMgr->addItemToCart($cart, $cartable);
        $this->cartMgr->removeItemFromCart($cart, $cartable);

        $items = $cart->getItems();
        $this->assertSame(0, $items->count());
    }

    public function testFindOpenCartByOwner()
    {
        $owner = new Person('person');

        $this->dm->persist($owner);
        $this->dm->flush();

        $cart = $this->cartMgr->createCart();
        $cart->setOwner($owner);
        $this->cartMgr->updateCart($cart);

        $ownersCart = $this->cartMgr->findOpenCartByOwner($owner);
        $this->assertSame($cart->getId(), $ownersCart->getId());

        $this->cartMgr->setCartState($cart, Cart::STATE_CLOSED);
        $ressult = $this->cartMgr->findOpenCartByOwner($owner);
        $this->assertNull($this->cartMgr->findOpenCartByOwner($owner));

        return $cart;
    }

    public function setup()
    {
        $pricingProvider = new SimpleCartPricingProvider();
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
