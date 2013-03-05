<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Tax;

use Vespolina\Entity\Tax\CategoryInterface;
use Vespolina\Entity\Tax\RateInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
interface ZoneInterface
{

    /**
     * Add the given rate to this zone
     *
     * @abstract
     * @param RateInterface $rate
     * @return void
     */
    function addRate(RateInterface $rate);

    /**
     * Get tax zone code (should be unique)
     */
    function getCode();

    /**
     * Name of the tax zone
     */
    function getName();

    /**
     * Retrieve a list of available rates
     *
     * @abstract
     * @return void
     */
    function getRates(CategoryInterface $category = null);

    /**
     * Return the strategy to be used for this zone to select a tax rate
     *
     * @return mixed
     */
    function getStrategy();

    /**
     * Set the tax zone code
     *
     * @abstract
     * @param  $code
     * @return void
     */
    function setCode($code);

    /**
     * Set the tax zone name
     *
     * @abstract
     * @param  $name
     * @return void
     */
    function setName($name);
}
