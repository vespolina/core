<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\CartBundle\Tests\Document;

use Doctrine\Bundle\MongoDBBundle\Tests\TestCase;
use Symfony\Component\Finder\Finder;

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
    protected $container;

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

    public function testFindItemInCart()
    {
        $cart = $this->persistNewCart();
        $cartable = $this->persistNewCartable('product');
        $addedItem = $this->cartMgr->addItemToCart($cart, $cartable);

        $item = $this->cartMgr->findItemInCart($cart, $cartable);

        $this->assertSame($item, $addedItem);
    }

    public function testSetItemQuantity()
    {
        $cart = $this->persistNewCart();
        $cartable = $this->persistNewCartable('product');
        $item = $this->cartMgr->addItemToCart($cart, $cartable);

        $this->assertSame(1, $item->getQuantity());

        $this->cartMgr->setItemQuantity($item, 4);
        $this->assertSame(4, $item->getQuantity());

        $this->cartMgr->setItemQuantity($item, 2);
        $this->assertSame(2, $item->getQuantity());
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
        $this->assertSame(1, $item->getQuantity());

        $existingItem = $this->cartMgr->addItemToCart($cart, $cartable);
        $items = $cart->getItems();
        $this->assertSame(1, $items->count());
        $this->assertSame(2, $existingItem->getQuantity());
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
        $this->assertNull($this->cartMgr->findOpenCartByOwner($owner));

        return $cart;
    }

    public function testGetActiveCartForOwner()
    {
        $owner = new Person('person');

        $this->dm->persist($owner);
        $this->dm->flush();

        $session = $this->container->get('session');
        // not really a test, but it does make sure we start empty
        $this->assertNull($session->get('vespolina_cart'));

        $firstPassCart = $this->cartMgr->getActiveCart($owner);
        $persistedCarts = $this->cartMgr->findBy(array());
        $this->assertSame(1, $persistedCarts->count(), 'there should only be one cart in the db');
        $this->assertSame($firstPassCart, $session->get('vespolina_cart'), 'the new cart should have been set for the session');

        $secondPassCart = $this->cartMgr->getActiveCart($owner);
        $this->assertSame($firstPassCart->getId(), $secondPassCart->getId());
        $this->assertSame(1, $persistedCarts->count(), 'there should only be one cart in the db');

        $session->clear('vespolina_cart');
        $thirdPassCart = $this->cartMgr->getActiveCart($owner);
        $this->assertSame($firstPassCart->getId(), $thirdPassCart->getId());
        $this->assertSame(1, $persistedCarts->count(), 'there should only be one cart in the db');
        $this->assertSame($thirdPassCart, $session->get('vespolina_cart'), 'the new cart should have been set for the session');
    }


    public function testGetActiveCartWithoutOwner()
    {
        $session = $this->container->get('session');
        // not really a test, but it does make sure we start empty
        $this->assertNull($session->get('vespolina_cart'));

        $firstPassCart = $this->cartMgr->getActiveCart();
        $persistedCarts = $this->cartMgr->findBy(array());
        $this->assertSame(1, $persistedCarts->count(), 'there should only be one cart in the db');
        $this->assertSame($firstPassCart, $session->get('vespolina_cart'), 'the new cart should have been set for the session');

        $secondPassCart = $this->cartMgr->getActiveCart();
        $this->assertSame($firstPassCart->getId(), $secondPassCart->getId());
        $this->assertSame(1, $persistedCarts->count(), 'there should only be one cart in the db');

        $session->clear('vespolina_cart');
        $thirdPassCart = $this->cartMgr->getActiveCart();
        $this->assertNotSame($firstPassCart->getId(), $thirdPassCart->getId());
        $this->assertSame(2, $persistedCarts->count(), 'there is a left over cart, this should probably be handled');
        $this->assertSame($thirdPassCart, $session->get('vespolina_cart'), 'the new cart should have been set for the session');
    }

    public function setup()
    {
        $pricingProvider = new SimpleCartPricingProvider();
        $pricingProvider->addCartHandler(new \Vespolina\CartBundle\Handler\DefaultCartHandler());

        $client = static::createClient();
        $container = $client->getContainer();
        $this->container = $container;

        $this->dm = self::createTestDocumentManager();
        $this->cartMgr = new CartManager(
            $this->dm,
            $container->get('session'),
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

    // BORROWED FROM WebTestCase.php //
    static protected $class;
    static protected $kernel;

    /**
     * Attempts to guess the kernel location.
     *
     * When the Kernel is located, the file is required.
     *
     * @return string The Kernel class name
     */
    static protected function getKernelClass()
    {
        $dir = isset($_SERVER['KERNEL_DIR']) ? $_SERVER['KERNEL_DIR'] : static::getPhpUnitXmlDir();

        $finder = new Finder();
        $finder->name('*Kernel.php')->depth(0)->in($dir);
        $results = iterator_to_array($finder);
        if (!count($results)) {
            throw new \RuntimeException('Either set KERNEL_DIR in your phpunit.xml according to http://symfony.com/doc/current/book/testing.html#your-first-functional-test or override the WebTestCase::createKernel() method.');
        }

        $file = current($results);
        $class = $file->getBasename('.php');

        require_once $file;

        return $class;
    }

    /**
     * Finds the directory where the phpunit.xml(.dist) is stored.
     *
     * If you run tests with the PHPUnit CLI tool, everything will work as expected.
     * If not, override this method in your test classes.
     *
     * @return string The directory where phpunit.xml(.dist) is stored
     */
    static protected function getPhpUnitXmlDir()
    {
        if (!isset($_SERVER['argv']) || false === strpos($_SERVER['argv'][0], 'phpunit')) {
            throw new \RuntimeException('You must override the WebTestCase::createKernel() method.');
        }

        $dir = static::getPhpUnitCliConfigArgument();
        if ($dir === null &&
            (is_file(getcwd().DIRECTORY_SEPARATOR.'phpunit.xml') ||
                is_file(getcwd().DIRECTORY_SEPARATOR.'phpunit.xml.dist'))) {
            $dir = getcwd();
        }

        // Can't continue
        if ($dir === null) {
            throw new \RuntimeException('Unable to guess the Kernel directory.');
        }

        if (!is_dir($dir)) {
            $dir = dirname($dir);
        }

        return $dir;
    }

    /**
     * Finds the value of configuration flag from cli
     *
     * PHPUnit will use the last configuration argument on the command line, so this only returns
     * the last configuration argument
     *
     * @return string The value of the phpunit cli configuration option
     */
    static private function getPhpUnitCliConfigArgument()
    {
        $dir = null;
        $reversedArgs = array_reverse($_SERVER['argv']);
        foreach ($reversedArgs as $argIndex => $testArg) {
            if ($testArg === '-c' || $testArg === '--configuration') {
                $dir = realpath($reversedArgs[$argIndex - 1]);
                break;
            } elseif (strpos($testArg, '--configuration=') === 0) {
                $argPath = substr($testArg, strlen('--configuration='));
                $dir = realpath($argPath);
                break;
            }
        }

        return $dir;
    }

    /**
     * Creates a Kernel.
     *
     * Available options:
     *
     *  * environment
     *  * debug
     *
     * @param array $options An array of options
     *
     * @return HttpKernelInterface A HttpKernelInterface instance
     */
    static protected function createKernel(array $options = array())
    {
        if (null === static::$class) {
            static::$class = static::getKernelClass();
        }

        return new static::$class(
            isset($options['environment']) ? $options['environment'] : 'test',
            isset($options['debug']) ? $options['debug'] : true
        );
    }

    /**
     * Creates a Client.
     *
     * @param array   $options An array of options to pass to the createKernel class
     * @param array   $server  An array of server parameters
     *
     * @return Client A Client instance
     */
    static protected function createClient(array $options = array(), array $server = array())
    {
        static::$kernel = static::createKernel($options);
        static::$kernel->boot();

        $client = static::$kernel->getContainer()->get('test.client');
        $client->setServerParameters($server);

        return $client;
    }
}
