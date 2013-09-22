<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Order;

use Vespolina\Exception\InvalidOptionsException;
use Vespolina\Entity\Product\ProductInterface;
use Vespolina\Entity\Item as BaseItem;

/**
 * Item is a class for items in an order
 *
 * @author Richard Shank <richard@vespolina.org>
 */
class Item extends BaseItem implements ItemInterface
{
    protected $attributes;
    protected $options;
    protected $product;
    protected $state;

    public function __construct(ProductInterface $product = null)
    {
        $this->product = $product;
    }

    /**
     * @inheritdoc
     */
    public function addAttribute($name, $value)
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addAttributes(array $attributes)
    {
        $this->attributes = array_merge($this->attributes, $attributes);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function clearAttributes()
    {
        $this->attributes = array();
    }

    /**
     * @inheritdoc
     */
    public function getAttribute($name)
    {
        if (isset($this->attributes[$name])) {

            return $this->attributes[$name];
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @inheritdoc
     */
    public function removeAttribute($name)
    {
        unset($this->attributes[$name]);
    }

    /**
     * @inheritdoc
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
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

    protected function setOptions(array $options)
    {
        if (!$this->product->validateOptions($options)) {
            throw new InvalidOptionsException('This combination of options is not valid for the product');
        }
        $this->options = $options;

        return $this;
    }

    protected function clearOptions()
    {
        if (!$this->product->validateOptions(array())) {
            throw new InvalidOptionsException('This product requires options');
        }
        $this->options = array();
    }

    /**
     * @inheritdoc
     */
    public function getProduct()
    {
        return $this->product;
    }

    protected function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getState()
    {
        return $this->state;
    }

    protected function setState($state)
    {
        $this->state = $state;

        return $this;
    }
}
