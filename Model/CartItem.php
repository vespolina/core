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

/**
 * CartItem implements a basic cart item implementation
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 */
abstract class CartItem implements CartItemInterface
{
    protected $cart;
    protected $cartableItem;
    protected $description;
    protected $options;
    protected $productId;
    protected $quantity;
    protected $state;

    public function __construct($cartableItem = null)
    {
        $this->cartableItem = $cartableItem;
        $this->options = new ArrayCollection();
    }

    /**
     * @inheritdoc
     */
    public function addOption($type, $value)
    {
        $this->options[$type] = $value;
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
    public function getDescription()
    {

        return $this->description;
    }
    /**
     * @inheritdoc
     */
    public function getOption($type)
    {

        return $this->options->get($type);
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
    public function getCartableItem()
    {
        return $this->cartableItem;
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
    public function setDescription($description)
    {
        $this->description = $description;
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