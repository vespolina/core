<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Pricing;

/**
 * PricingContext implements a data container holding price variables needed for calculation
 *
 * @author Daniel Kucharski <daniel@vespolina.org>
 */

use Vespolina\Entity\Pricing\PricingContextInterface;

class PricingContext extends \Pimple implements PricingContextInterface
{

    /**
     * Convenience getter
     *
     * @param $key
     * @return mixed
     */
    public function get($key, $default = null) {

        if ($this->offsetExists($key)) {

            return $this->offsetGet($key);
        } else {

            return $default;
        }
    }

    /**
     * Convenience setter
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value) {

        return $this->offsetSet($key, $value);
    }
}