<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\CartBundle\Model\CartItemInterface;
use Vespolina\CartBundle\Model\Option\OptionInterface;

/**
 * CartItem implements a basic cart item implementation
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 */
class CartItem implements CartItemInterface
{
    protected $cart;
    protected $options;
    protected $product;
    protected $productId;
    protected $quantity;
    protected $state;

    public function __construct($product = null)
    {
        $this->product = $product;
        $this->options = new ArrayCollection();
    }


    /**
     * @inheritdoc
     */
    public function addOption(OptionInterface $option)
    {

        $this->options[$option->getType()] = $option;
    }

    /**
     * @inheritdoc
     */
    public function getCart()
    {

        return $this->cart;
    }

    /**
     * @inheritdoc
     */
    public function getOption($type)
    {

        //TODO: increase performance

        foreach($this->getOptions() as $option) {

            if ($option->getType() == $type )

                return $option;
        }
    }

    /**
     * @inheritdoc
     */
    public function getOptions()
    {

        return $this->options;
    }

    /**
     * @inheritdoc
     */
    public function getProduct()
    {

        return $this->product;
    }

    /**
     * @inheritdoc
     */
    public function getState()
    {

        return $this->state;
    }

    /**
     * @inheritdoc
     */
    public function getQuantity()
    {

        return $this->quantity;
    }

    /**
     * @inheritdoc
     */
    public function setCart(CartInterface $cart)
    {

        $this->cart = $cart;
    }

    /**
     * @inheritdoc
     */
    public function setProduct($product)
    {

        $this->product = $product;
    }

    /**
     * @inheritdoc
     */
    public function setQuantity($quantity)
    {

        $this->quantity = $quantity;
    }

    /**
     * @inheritdoc
     */
    public function setState($state)
    {

        $this->state = $state;
    }

}