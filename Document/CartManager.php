<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\CartBundle\Document;

use Symfony\Component\DependencyInjection\Container;

use Vespolina\CartBundle\Document\Cart;
use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\CartBundle\Model\CartItemInterface;
use Vespolina\CartBundle\Model\CartManager as BaseCartManager;
/**
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
class CartManager extends BaseCartManager
{
    protected $dm;
    protected $primaryIdentifier;
    protected $cartRepo;

    public function __construct(Container $container)
    {
        $this->dm = $container->get('doctrine.odm.mongodb.default_document_manager');
        $this->salesOrderRepo = $this->dm->getRepository('Vespolina\CartBundle\Document\Cart'); // TODO make configurable

        parent::__construct($container);
    }

    /**
     * @inheritdoc
     */
    public function createCart($cartType = 'default')
    {
        // TODO: this will be using factories to allow for a number of different types of Cart classes
        $cart = new Cart();
        $this->init($cart);

        return $cart;
    }

    public function createItem($product = null)
    {
        $itemBaseClass = 'Vespolina\CartBundle\Document\CartItem';

        if ($itemBaseClass) {

            $cartItem = new $itemBaseClass($product);

            return $cartItem;
        }
    }

    /**
     * @inheritdoc
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->cartRepo->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @inheritdoc
     */
    public function findCartById($id)
    {

        return $this->cartRepo->find($id);
    }

    /**
     * @inheritdoc
     */
    public function findCartByIdentifier($name, $code)
    {

    }

    /**
     * @inheritdoc
     */
    public function updateCart(CartInterface $cart, $andFlush = true)
    {
        $this->dm->persist($cart);
        if ($andFlush) {
            $this->dm->flush();
        }
    }
}
