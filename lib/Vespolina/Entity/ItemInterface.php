<?php

namespace Vespolina\Entity;

/**
 * Item class with common logic for the order and invoice items
 *
 * @author Luis Cordova <cordoval@gmail.com>
 */
interface ItemInterface
{
    /**
     * Return the pricing set for this item
     *
     * @return \Vespolina\Entity\Pricing\PricingSetInterface|null
     */
    function getPrice($type = 'unit');

    /**
     * Return the quantity of the item
     *
     * @return integer
     */
    function getQuantity();

    /**
     * Set the parent order for this item
     *
     * @param ItemableInterface $parent
     * @return self
     */
    function setParent(ItemableInterface $parent);
}