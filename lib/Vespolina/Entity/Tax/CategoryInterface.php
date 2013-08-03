<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Tax;

/**
 * TaxCategory holds the basic tax classification for various entities such as
 *  - defining the customer tax category.  eg. "wholesale customer"
 *  - defining the product tax category eg. "prepared food"
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 */
interface CategoryInterface
{
    /**
     * Get code
     */
    function getCode();

    /**
     * Name of the tax category
     */
    function getName();

    /**
     * Set the code
     *
     * @abstract
     * @param  $code
     * @return void
     */
    function setCode($code);

    /**
     * Set the tax category name
     *
     * @abstract
     * @param  $name
     * @return void
     */
    function setName($name);
}
