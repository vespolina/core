<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Product;

use Vespolina\Entity\Asset\AssetInterface;
use Vespolina\Entity\Pricing\PricingSetInterface;
use Vespolina\Entity\Pricing\PricingSet;
use Vespolina\Entity\Product\BaseProductInterface;

interface MerchandiseInterface extends BaseProductInterface
{
    /**
     * Set the date this merchandise becomes active in the store.
     *
     * @param \DateTime $activateOn
     */
    function setActivateOn(\DateTime $activateOn);

    /**
     * Return the date when this merchandise becomes active in the store.
     *
     * @return \DateTime
     */
    function getActivateOn();

    /**
     * Set the merchandise to an active state in the store.
     *
     * When active is set to true, if the current time is not in the activate/deactivate time
     * range or the activateOn property is null, the activateOn will be set to the current time.
      *
     * When active is set to false, the deactivateOn will be set to the current time.
     *
     * @param boolean $active
     */
    function setActive($active);

    /**
     * Return if this merchandise is active. If the active property is not set, the activateOn/deactivateOn
     * time range is used to determine if its active.
     *
     * @return boolean
     */
    function getActive();

    /**
     * Add a asset to the collection
     *
     * @param \Vespolina\Entity\Asset\AssetInterface $asset
     */
    function addAsset(AssetInterface $asset);

    /**
     * Add a collection of assets
     *
     * @param array $assets
     */
    function addAssets(array $assets);

    /**
     * Remove all assets from the collection
     */
    function clearAssets();

    /**
     * Return a collection of assets
     *
     * @return array of \Vespolina\Entity\Asset\AssetInterface
     */
    function getAssets();

    /**
     * Remove an asset from the collection
     *
     * @param AssetInterface $asset
     */
    function removeAsset(AssetInterface $asset);

    /**
     * Set a collection of assets
     *
     * @param array $assets
     */
    function setAssets(array $assets);

    /**
     * Set the date this merchandise becomes inactive in the store.
     *
     * @param \DateTime $deactivateOn
     */
    function setDeactivateOn(\DateTime $deactivateOn);

    /**
     * Return the date when this merchandise is no longer active in the store.
     *
     * @return \DateTime
     */
    function getDeactivateOn();

    /**
     * Return the PricingSet for this merchandise
     *
     * @param \Vespolina\Entity\Pricing\PricingSetInterface $pricingSet
     * @return
     */
    function setPricing(PricingSetInterface $pricingSet);

    /**
     * Return the PricingSet for this merchandise
     *
     * @return \Vespolina\Entity\Pricing\PricingSet $pricingSet
     */
    function getPricing();

    /**
     * Return the product of this merchandise
     *
     * @return \Vespolina\Entity\Product\ProductInterface
     */
    function getProduct();

    /**
     * Set the store this merchandise belongs in
     *
     * @param $store
     */
    function setStore($store);

    /**
     * Return the store this merchandise belongs in
     *
     * @return
     */
    function getStore();
}
