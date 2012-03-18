<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Handler;

use Vespolina\CartBundle\Model\CartItemInterface;

interface CartHandlerInterface
{
    function createPricingSet();

    function determineCartItemPrices(CartItemInterface $cartItem, $pricingContext);

    function getType();
}
