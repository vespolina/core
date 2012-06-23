<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\CartBundle\Document;

use Vespolina\CartBundle\Model\CartItem as AbstractCartItem;
use Vespolina\CartBundle\Pricing\PricingSet;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
abstract class BaseCartItem extends AbstractCartItem
{
    protected $pricingSetData;

    public function postLoadCartItem()
    {
        $this->pricingSet = new PricingSet();
        $this->pricingSet->setAll($this->pricingSetData);
    }

    public function prePersistCartItem()
    {
        $this->pricingSetData = $this->pricingSet->all();
    }
}