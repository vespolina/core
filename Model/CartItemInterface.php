<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\CartBundle\Model;

use \DateTime;
use Vespolina\CartBundle\Model\CartInterface;

interface CartItemInterface
{
    /**
     * Get the date when this item was created
     */
    function getCreatedAt();

    /**
     * Get the merchandise instance
     */
    function getMerchandise();

    /**
     * Get cart item option for a given name
     *
     * @abstract
     * @param  $name
     * @return string
     */
    function getOption($name);

    /**
     * Retrieve all options
     * @abstract
     * @return array()
     */
    function getOptions();

    /**
     * Get quantity
     *
     * @abstract
     * @return integer
     *
     */
    function getQuantity();

    /**
     * Get the date when this item was modified
     */
    function getUpdatedAt();

    /**
     * Set the date this item was created
     */
    function setCreatedAt(DateTime $createdAt);

    /**
     * Set the merchandise instance
     */
    function setMerchandise($merchandise);
    
    /**
     * Set the date this item has been modified
     */
    function setUpdatedAt(DateTime $updatedAt);

    /**
     * Set a cart option by a given name and value
     *
     * @abstract
     * @param  $name
     * @param  $value
     * @return void
     */
    function setOption($name, $value);

    /**
     * Set quantity
     * 
     * @abstract
     * @param  $quantity
     * @return void
     */
    function setQuantity($quantity);
}