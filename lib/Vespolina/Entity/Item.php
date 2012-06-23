<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity;

use Vespolina\Entity\ItemInterface;

/**
 * Item is a class for items in an order
 *
 * @author Richard Shank <develop@zestic.com>
 */
class Item implements ItemInterface
{
    protected $name;
    protected $options;
    protected $parent;
    protected $product;
    protected $quantity;
    protected $state;

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
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function getOption($type)
    {
        if (isset($this->options[$type])) {

            return $this->options[$type];
        }

        return null;
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
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @inheritdoc
     */
    public function setParent(OrderInterface $parent)
    {
        $this->parent = $parent;
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
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @inheritdoc
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Add a option for the product in this item
     *
     * @param string $type
     * @param string $value
     */
    protected function addOption($type, $value)
    {
        $this->options[$type] = $value;
    }

    protected function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    protected function setState($state)
    {
        $this->state = $state;
    }

    protected function setProduct($product)
    {
        $this->product = $product;
    }
}
