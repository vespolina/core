<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Pricing;

interface PricingSetInterface extends \ArrayAccess
{
    function getNetValue();
    function getTotalValue();
    function get($name);
}
