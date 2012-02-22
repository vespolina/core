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
    protected $isRecurring;
    protected $name;
    protected $options;
    protected $productId;
    protected $prices;
    protected $quantity;
    protected $state;
    protected $totalPrice;
    protected $unitPrice;

    public function __construct($cartableItem = null)
    {
        $this->cartableItem = $cartableItem;
        $this->isRecurring = false;
        $this->options = array();
        $this->prices = array();
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


    public function getPrice($name)
    {
        if (array_key_exists($name, $this->prices)) {

            return $this->prices[$name];
        }
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

    public function setPrice($name, $price)
    {
        $this->prices[$name] = $price;
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

    /**
     * @inheritdoc
     */
    public function getTotalPrice($refresh = false)
    {

        return $this->getPrice('total');
    }

    /**
     * @inheritdoc
     */
    public function setUnitPrice($unitPrice)
    {
        $this->setPrice('unitPrice', $unitPrice);
    }

    /**
     * @inheritdoc
     */
    public function setTotalPrice($totalPrice)
    {
        $this->setPrice('total', $totalPrice);
    }

    /**
     * @inheritdoc
     */
    public function getUnitPrice()
    {
        if ($unitPrice = $this->getPrice('unitPrice')) {

            return $unitPrice;
        }

        return $this->cartableItem->getPrice();
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
    function isRecurring()
    {
        return $this->isRecurring;
    }

}