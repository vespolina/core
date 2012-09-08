<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Product;

use Vespolina\Entity\Asset\MediaInterface;
use Vespolina\Entity\Product\FeatureInterface;
use Vespolina\Entity\Identifier\IdentifierInterface;
use Vespolina\Entity\Product\OptionInterface;
use Vespolina\Entity\Product\OptionGroupInterface;

/**
 * @author Richard D Shank <develop@zestic.com>
 * @author Daniel Kucharski <daniel@xerias.be>
 */
interface BaseProductInterface
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
     * Remove all features from the product
     */
    function clearFeatures();

    /**
     * Return the features of the product
     *
     * @return \Vespolina\Entity\Product\FeatureInterface
     */
    function getFeatures();

    /**
     * Set the features of the product to a feature set
     *
     * @param $features
     */
    function setFeatures($features);

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
     * @param \Vespolina\Entity\Product\OptionGroupInterface $optionGroup
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
     * Return the identifier set generated from the option choices
     *
     * @return array of Vespolina\ProductBundle\Identifier\ProductIdentifierSetInterface
     */
    function getIdentifierSets();

    function getIdentifiers();

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
     * Add a media to the collection
     *
     * @param MediaInterface $media
     */
    function addMedia(MediaInterface $media);

    /**
     * Add a collection of medias
     *
     * @param array $medias
     */
    function addMediaCollection(array $medias);

    /**
     * Remove all media from the collection
     */
    function clearMedia();

    /**
     * Return a collection of media
     *
     * @return array of MediaInterface
     */
    function getAllMedia();

    /**
     * Remove a media from the collection
     *
     * @param MediaInterface $media
     */
    function removeMedia(MediaInterface $media);

    /**
     * Set a collection of media
     *
     * @param array $media
     */
    function setMedia(array $media);

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

    /**
     * Return the cart creation date
     *
     * @return
     */
    function getCreatedAt();

    /**
     * Set the cart creation date
     *
     * @param DateTime $createdAt
     */
    function setCreatedAt(\DateTime $createdAt);

    /**
     * Return the cart update date
     *
     * @return
     */
    function getUpdatedAt();

    /**
     * Set the cart update date
     *
     * @param DateTime $updatedAt
     */
    function setUpdatedAt(\DateTime $updatedAt);
}
