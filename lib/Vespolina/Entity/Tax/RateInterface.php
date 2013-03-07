<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Tax;

interface RateInterface
{
    /**
     * Get unique code
     */
    public function getCode();

    /**
     * Name of the tax rate
     */
    public function getName();

    /**
     * Value of the tax rate
     */
    public function getRate();

    /**
     * Set the tax zone code
     *
     * @abstract
     * @param  $code
     * @return void
     */
    public function setCode($code);

    /**
     * Set the tax rate name
     *
     * @abstract
     * @param  $name
     * @return void
     */
    public function setName($name);

    /**
     * Set the tax rate value
     *
     * @abstract
     * @param  $rate
     * @return void
     */
    public function setRate($rate);
}
