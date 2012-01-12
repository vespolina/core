<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
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
 * @author Richard Shank <develop@zestic.com>
 */
abstract class CartItem implements CartItemInterface
{
    protected $cart;
    protected $cartableItem;
    protected $description;
    protected $isSubscription;
    protected $name;
    protected $options;
    protected $price;
    protected $productId;
    protected $quantity;
    protected $state;

    public function __construct($cartableItem = null)
    {
        $this->cartableItem = $cartableItem;
        //$this->options = new ArrayCollection();
        $this->isSubscription = false;
        $this->options = array();
        $this->quantity = 1;
    }

    /**
     * @inheritdoc
     */
    public function addOption($type, $value = null)
    {
        if (is_array($type)) {
            $key = key($type);
            $value = $type[$key];
            $type = $key;
        }

        $this->options[$type] = $value;
        $this->calculatePrice();
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
        if (array_key_exists($type, $this->options)) {

            return $this->options[$type];
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @inheritdoc
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        $this->calculatePrice();
    }

    /**
     * @inheritdoc
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @inheritdoc
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @inheritdoc
     */
    public function getPrice()
    {
        $this->calculatePrice();
        return $this->price;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    function isSubscription()
    {
        return $this->isSubscription;
    }

    protected function calculatePrice()
    {
        $price = $this->cartableItem->getPrice();
        foreach($this->options as $key => $option) {
            $productOption = $this->cartableItem->getOptionSet($option);
            $price += $productOption->getUpcharge();
        }
        $this->price = $price * $this->quantity;
    }
}