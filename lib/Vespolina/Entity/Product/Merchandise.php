<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Product;

use Vespolina\Entity\Pricing\PricingSet;
use Vespolina\Entity\Product\BaseProduct;
use Vespolina\Entity\Product\MerchandiseInterface;

class Merchandise extends BaseProduct implements MerchandiseInterface
{
    protected $activateOn;
    protected $active;
    protected $assets;
    protected $deactivateOn;
    protected $pricing;
    protected $product;
    protected $slug;
    protected $store;
    protected $terms;

    /**
     * @inheritdoc
     */
    public function setActivateOn(\DateTime $activateOn)
    {
        $this->activateOn = $activateOn;
    }

    /**
     * @inheritdoc
     */
    public function getActivateOn()
    {
        return $this->activateOn;
    }

    /**
     * @inheritdoc
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @inheritdoc
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @inheritdoc
     */
    public function setDeactivateOn(\DateTime $deactivateOn)
    {
        $this->deactivateOn = $deactivateOn;
    }

    /**
     * @inheritdoc
     */
    public function getDeactivateOn()
    {
        return $this->deactivateOn;
    }

    /**
     * @inheritdoc
     */
    public function setPricing(PricingSet $pricing)
    {
        $this->pricing = $pricing;
    }

    /**
     * @inheritdoc
     */
    public function getPricing()
    {
        return $this->pricing;
    }

    /**
     * @inheritdoc
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @inheritdoc
     */
    public function setStore($store)
    {
        $this->store = $store;
    }

    /**
     * @inheritdoc
     */
    public function getStore()
    {
        return $this->store;
    }
}
