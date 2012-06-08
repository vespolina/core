<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity;

use Vespolina\Entity\FeatureInterface;
use Vespolina\Entity\IdentifierInterface;
use Vespolina\Entity\OptionInterface;
use Vespolina\Entity\OptionGroupInterface;

/**
 * @author Richard D Shank <develop@zestic.com>
 * @author Daniel Kucharski <daniel@xerias.be>
 */
interface ProductInterface
{
    /**
     * Set the description of the product
     *
     * @param $description
     */
    function setDescription($description);

    /**
     * Return the description of the product
     *
     * @return string
     */
    function getDescription();

    /**
     * Add a single feature to the product
     *
     * @param FeatureInterface $feature
     */
    function addFeature(FeatureInterface $feature);

    /**
     * Add an array of feature to the product
     *
     * @param array of Vespolina\Entity\FeatureInterface $features
     */
    function addFeatures(array $features);

    /**
     * Remove all features from the product
     */
    function clearFeatures();

    /**
     * Return the features of the product
     *
     * @return Vespolina\Entity\FeatureInterface
     */
    function getFeatures();

    /**
     * Return a feature by its type
     *
     * @param $type
     *
     * @return Vespolina\Entity\FeatureInterface
     */
    function getFeature($type);

    /**
     * Remove a feature by its type
     *
     * @param $type
     */
    function removeFeature($type);

    /**
     * Set the features of the product to a feature set
     *
     * @param $features
     */
    function setFeatures($features);

    /**
     * Return the primary ProductIdentifierSet of the product
     *
     * @return identifiers
     */
    function getPrimaryIdentifierSet();

    /**
     * Set the name of the product
     *
     * @param $name
     */
    function setName($name);

    /**
     * Return the name of the product
     *
     * @return string
     */
    function getName();

    /**
     * Add an option set to the product
     *
     * @param Vespolina\Entity\OptionGroupInterface $optionGroup
     *
     */
/** remove for now to get feature tests to pass
    function addOptionGroup(OptionGroupInterface $optionGroup);
*/
    /**
     * Remove an options set from the product
     *
     * @param string name of group $name
     */
    function removeOptionGroup($name);

    /**
     * Set the options of the product to an option set
     *
     * @param array of Vespolina\ProductBundle\Node\OptionGroupInterface $optionGroup
     */
    function setOptions($options);

    /**
     * Remove the option groups from the project
     *
     */
    function clearOptions();

    /**
     * Return the options of the product
     *
     * @return array of Vespolina\ProductBundle\Option\OptionGroupInterface
     */
    function getOptions();

    /**
     * Return a new instance of the ProductIdentiferSet, based on the class passed into the Product from the constructor
     *
     * @return instance of Vespolina\ProductBundle\Identifier\ProductIdentifierSetInterface
     */
    function createProductIdentifierSet($options);

    /**
     * Return the identifier set generated from the option choices
     *
     * @return array of Vespolina\ProductBundle\Identifier\ProductIdentifierSetInterface
     */
    function getIdentifierSets();

    /**
     * Return an identifier set for the option set combination
     *
     * @param array (optional) option set or null returns primary
     *
     * @return Vespolina\ProductBundle\Identifier\ProductIdentifierSetInterface
     */
    function getIdentifierSet($target = null);

    /**
     * Add an identifier to an identifier set. No target adds identifier to primary.
     *
     * @param $identifier
     * @param $target
     */
    function addIdentifier($identifier, $target = null);

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
     * Set the product type, ie shirt, cd, tickets
     *
     * @param $type
     */
    function setType($type);

    /**
     * Get the product type.
     * @return type
     */
    function getType();
}
