<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Handler;

use Vespolina\CartBundle\Handler\CartHandlerInterface;
use Vespolina\CartBundle\Model\CartItemInterface;
use Vespolina\CartBundle\Pricing\PricingSet;

/**
 * This provides a default set of actions for the methods that can be used by any other CartHandler by extending this class
 */
abstract class AbstractCartHandler implements CartHandlerInterface
{
    protected $taxationManager;

    public function createPricingSet()
    {
        return new PricingSet();
    }

    public function determineCartItemPrices(CartItemInterface $cartItem, $pricingContext)
    {
        throw new \Exception("Sorry determineCartItemPrices() doesn't have default functionality in place");
    }

    public function setTaxationManager($taxationManager)
    {
        $this->taxationManager = $taxationManager;
    }
}
