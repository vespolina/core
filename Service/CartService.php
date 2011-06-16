<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Service;

use \DateTime;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Bundle\Bundle;

use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\CartBundle\Service\CartServiceInterface;

class CartService extends ContainerAware implements CartServiceInterface
{
    protected $carts;

    function __construct()
    {
        $this->carts = array();
    }

    /**
     * @inheritdoc
     */
    public function createItem(CartInterface $cart)
    {
        $itemBaseClass = 'Vespolina\CartBundle\Model\CartItem';

        if ($itemBaseClass )
        {

            $cartItem = new $itemBaseClass($cart);

            $cartItem->setCreatedAt(new DateTime());
            $cart->addItem($cartItem);

            return $cartItem;
        }
    }

    /**
     * @inheritdoc
     */
    public function createCart($name = 'default')
    {
        $cartClass = 'Vespolina\CartBundle\Model\Cart';

        if ($cartClass )
        {

            $cart = new $cartClass($name);

            $cart->setCreatedAt(new DateTime());
            $this->carts[$name] = $cart;
        
            return $cart;
        }
    }

    
    /**
     * @inheritdoc
     */
    public function save(CartInterface $cart)
    {
    }
}