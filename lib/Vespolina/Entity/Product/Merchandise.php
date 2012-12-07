<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Product;

use Vespolina\Entity\Asset\AssetInterface;
use Vespolina\Entity\Pricing\PricingSet;
use Vespolina\Entity\Product\BaseProduct;
use Vespolina\Entity\Product\MerchandiseInterface;
use Vespolina\Entity\Product\ProductInterface;

class Merchandise extends BaseProduct implements MerchandiseInterface
{
    protected $activateOn;
    protected $active;
    protected $deactivateOn;
    protected $pricing;
    protected $product;
    protected $slug;
    protected $store;

    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
        $rc = new \ReflectionClass('Vespolina\Entity\Product\BaseProduct');
        $properties = $rc->getProperties();
        foreach ($properties as $property) {
            if ($property->getName() !== 'assets') {
                $property->setAccessible(true);
                $value = $property->getValue($product);
                $property->setValue($this, $value);
                $property->setAccessible(false);
            }
        }
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getSlug()
    {
        return $this->slug;
    }

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
    public function addAsset(AssetInterface $asset)
    {
        $this->assets[] = $asset;
    }

    /**
     * @inheritdoc
     */
    public function addAssets(array $assets)
    {
        $this->assets = array_merge($this->assets, $assets);
    }

    /**
     * @inheritdoc
     */
    public function clearAssets()
    {
        $this->assets = array();
    }

    /**
     * @inheritdoc
     */
    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * @inheritdoc
     */
    public function removeAsset(AssetInterface $asset)
    {
        foreach ($this->assets as $key => $assetToCompare) {
            if ($assetToCompare == $asset) {
                unset($this->assets[$key]);
                break;
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function setAssets(array $assets)
    {
        $this->assets = $assets;
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
