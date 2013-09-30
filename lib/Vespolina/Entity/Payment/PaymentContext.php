<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Payment;

/**
 * PaymentContext implements a data container holding payment variables needed for payment handling
 *
 */
class PaymentContext extends \Pimple
{
    /**
     * Convenience getter
     *
     * @param $key
     * @param $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if ($this->offsetExists($key)) {
            return $this->offsetGet($key);
        }

        return $default;
    }

    /**
     * Convenience setter
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        return $this->offsetSet($key, $value);
    }
}