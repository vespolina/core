<?php
/**
 * (c) 2013 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\Entity\Pricing\Element;

use Vespolina\Entity\Pricing\PricingElement;

class TotalValueElement extends PricingElement
{
    protected $order = 100000;

    protected function doProcess($context, $processed)
    {
        $totalValue = $processed['netValue'];
        // todo: calculate other preset groups 'discounts', 'surcharge', 'taxes'

        $processed['totalValue'] = $totalValue;

        return $processed;
    }
}
