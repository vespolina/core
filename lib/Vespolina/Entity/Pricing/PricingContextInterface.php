<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\Entity\Pricing;

interface PricingContextInterface
{
    /**
     * Get the quantity of items for this pricing context. This is a shortcut for get('quantity')
     *
     * @return integer
     */
    function getQuantity();

    /**
     * Get the quantity of items for this pricing context
     *
     * @param integer
     *
     * @return $this
     */
    function setQuantity($quantity);

    /**
     * Get the value for a set variable in this context or null if the variable is not set
     *
     * @param $key
     * @param null $default // todo, how would this work since the context is used for processing the PricingSet?
     *
     * @return null | mixed
     */
    function get($key, $default = null);

    /**
     * Set the value for a variable that will be used by a PricingSet
     *
     * @param string $key
     * @param $value
     *
     * @return $this
     */
    function set($key, $value);
}
