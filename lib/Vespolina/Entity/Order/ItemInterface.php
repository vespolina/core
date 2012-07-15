<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Order;

use Vespolina\Entity\Order\OrderInterface;

/**
 * ItemInterface is an interface for items in an order
 *
 * @author Richard Shank <develop@zestic.com>
 */
interface ItemInterface
{
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
     * @return Vespolina\Entity\Order\OrderInterface
     */
    function getParent();

    /**
     * Set the parent order for this item
     *
     * @param Vespolina\Entity\Order\OrderInterface $parent
     */
    function setParent(OrderInterface $parent);

    /**
     * Return the product for this item
     *
     * @return Vespolina\Entity\ProductInterface
     */
    function getProduct();

    /**
     * Return the quantity of the item
     *
     * @return integer
     */
    function getQuantity();

    /**
     * Get the cart state for this item
     *
     * @abstract
     * @return void
     */
    function getState();
}
