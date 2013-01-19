<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Pricing;

interface PricingElementInterface
{
    /**
     * Return the net value of this PricingElement.
     *
     * @return mixed
     */
    function getNetValue();

    /**
     * Set the order of this element being processed. If the order is not set, it is saved until the end of the
     * processing to be executed. The higher the number, the later it is executed.
     *
     * @param integer $order
     */
    function setOrder($order);

    /**
     * Return the order of this element's execution
     *
     * @return integer
     */
    function getOrder();

    /**
     * Return the processed value of this PricingElement.
     *
     * @return mixed
     */
    function getValue();

    /**
     * Process this pricing element. The results are passed back and also available with a call to getValue(). A null is
     * returned on failure
     *
     * @return mixed
     */
    function process();
}
