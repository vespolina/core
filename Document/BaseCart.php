<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\CartBundle\Document;

use Vespolina\CartBundle\Model\Cart as AbstractCart;
use Vespolina\CartBundle\Pricing\PricingSet;
/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
abstract class BaseCart extends AbstractCart
{
    protected $id;
    protected $pricingSetData;

    public function getId()
    {
        return $this->id;
    }

    public function postLoadCart()
    {
        $this->pricingSet = new PricingSet();
        $this->pricingSet->setAll($this->pricingSetData);
    }

    public function prePersistCart()
    {
        $this->pricingSetData = $this->pricingSet->all();
    }
}