<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\Pricing;

interface PricingSetInterface
{

    function all();
    function get($name);
    function set($name, $value);

}
