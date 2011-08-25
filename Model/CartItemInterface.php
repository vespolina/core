<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 
 
namespace Vespolina\CartBundle\Model;

use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\MerchandiseBundle\Model\MerchandiseInterface;

/**
 * CartItemInterface is a generic interface for shopping cart item
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 */
interface CartItemInterface
{

    /**
     * @abstract
     *
     * @return MerchandiseInterface merchandise
     */
    function getMerchandise();

    /**
     * Get all merchandise options
     *
     * @abstract
     * @return void
     */
    function getMerchandiseOptions();

    /**
     * Get the cart status for this item
     *
     * @abstract
     * @return void
     */
    function getStatus();

    /**
     * Get the quantity
     *
     * @abstract
     * @return void
     */
    function getQuantity();

    /**
     * Set the referenced merchandise
     *
     * @abstract
     * @param $merchandise
     * @return void
     */
    function setMerchandise($merchandise);

    /**
     * Set a merchandise option
     *
     * @abstract
     * @param $name
     * @param $value
     * @return void
     */
    function setMerchandiseOption($name, $value);

    /**
     * Set the status of this item
     *
     * @abstract
     * @param $status
     * @return void
     */
    function setStatus($status);

    /**
     * Set the quantity
     *
     * @abstract
     * @param $quantity
     * @return void
     */
    function setQuantity($quantity);
}