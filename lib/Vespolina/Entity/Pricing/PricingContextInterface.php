<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Pricing;

interface PricingContextInterface
{

    /**
     * Get the value for a set variable in this context or null if the variable is not set
     *
     * @param $key
     * @param null $default
     *
     * @return null | mixed
     */
    //function get($key, $default = null);

    /**
     * Set the value for a variable that will be used by a PricingSet
     *
     * @param string $key
     * @param $value
     *
     * @return $this
     */
    //function set($key, $value);
}
