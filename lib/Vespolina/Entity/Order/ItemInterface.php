<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Order;

use Vespolina\Entity\ItemableInterface;
use Vespolina\Entity\ItemInterface as BaseItemInterface;

/**
 * ItemInterface is an interface for items in an order
 *
 * @author Richard Shank <develop@zestic.com>
 */
interface ItemInterface extends BaseItemInterface
{
    /**
     * Add an attribute to the collection
     *
     * @param $name
     * @param $value
     * @return
     */
    function addAttribute($name, $value);

    /**
     * Add a collection of Attribute
     *
     * @param array $attributes
     */
    function addAttributes(array $attributes);

    /**
     * Remove all attributes from the collection
     */
    function clearAttributes();

    /**
     * Return a specific attribute from the collection
     *
     * @param $name
     */
    function getAttribute($name);

    /**
     * Return a collection of Attribute
     *
     * @return array of attributes
     */
    function getAttributes();

    /**
     * Remove an attribute from the collection
     *
     * @param string $name
     */
    function removeAttribute($name);

    /**
     * Set a collection of Attribute
     *
     * @param array $attributes
     */
    function setAttributes(array $attributes);

    /**
     * Return the name of the cart item
     *
     * @return string
     */
    function getName();

    /**
     * Set the name of the cart item
     *
     * @param string $name
     */
    function setName($name);

    /**
     * Get all options
     *
     * @abstract
     * @return void
     */
    function getOptions();

    /**
     * Return the order/cart where this item belongs
     *
     * @return \Vespolina\Entity\ItemableInterface
     */
    function getParent();

    /**
     * Set a pricing set for this item
     */
    function setPricing($pricingSet);

    /**
     * Return the product for this item
     *
     * @return \Vespolina\Entity\Product\ProductInterface
     */
    function getProduct();

    /**
     * Get the cart state for this item
     *
     * @abstract
     * @return void
     */
    function getState();
}
