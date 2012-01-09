<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Model;

/**
 * CartableItemInterface is a generic interface for using a product or service as a cart item
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
interface CartableItemInterface
{
    /**
     * Return the id of the CartableItem
     *
     * @return int id
     */
    function getId();

    /**
     * Return the name of the CartableItem
     *
     * @return string name
     */
    function getName();

    /**
     * Set the price of the item
     *
     * @param $price
     */
    function setPrice($price);

    /**
     * Return the price of the item
     *
     * @return price
     */
    function getPrice();
}