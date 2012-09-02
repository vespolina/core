<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Product;

use Vespolina\Entity\Identifier\IdentifierInterface;
use Vespolina\Entity\Product\BaseProductInterface;
use Vespolina\Entity\Product\FeatureInterface;
use Vespolina\Entity\Product\OptionInterface;
use Vespolina\Entity\Product\OptionGroupInterface;

/**
 * @author Richard D Shank <develop@zestic.com>
 * @author Daniel Kucharski <daniel@xerias.be>
 */
interface ProductInterface extends BaseProductInterface
{
    /**
     * Add a single feature to the product
     *
     * @param FeatureInterface $feature
     */
    function addFeature(FeatureInterface $feature);

    /**
     * Add an array of feature to the product
     *
     * @param array of Vespolina\Entity\Product\FeatureInterface $features
     */
    function addFeatures(array $features);

    /**
     * Return a feature by its type
     *
     * @param $type
     *
     * @return \Vespolina\Entity\Product\FeatureInterface
     */
    function getFeature($type);

    /**
     * Remove a feature by its type
     *
     * @param $type
     */
    function removeFeature($type);

    /**
     * Return a new instance of the ProductIdentifierSet, based on the class passed into the Product from the constructor
     *
     * @return instance of Vespolina\ProductBundle\Identifier\ProductIdentifierSetInterface
     */
    function createProductIdentifierSet($options);

    /**
     * Use a different name or different technique
     *
     * These are valid types of products
     * Product::PHYSICAL
     * Product::UNIQUE
     * Product::DOWNLOAD
     * Product::TIME
     * Product::SERVICE
     *
     * @param $type
     */

    /**
     * Set the product slug
     *
     * @param $slug
     */
    function setSlug($slug);

    /**
     * Get the product slug.
     * @return slug
     */
    function getSlug();

    /**
     * Check the passed options to make sure it is a valid combination
     *
     * @param array $options
     *
     * @return boolean
     */
    function validateOptions(array $options);
}
