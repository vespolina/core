<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Product;

use Vespolina\Media\MediaInterface;
use Vespolina\Entity\Brand\BrandInterface;
use Vespolina\Entity\Identifier\IdentifierInterface;
use Vespolina\Entity\Product\AttributeInterface;
use Vespolina\Entity\Product\OptionInterface;
use Vespolina\Entity\Product\OptionGroupInterface;
use Vespolina\Entity\Taxonomy\TaxonomyNodeInterface;

/**
 * @author Richard D Shank <richard@vespolina.org>
 * @author Daniel Kucharski <daniel@vespolina.org>
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
     * Returns the id from a product.  If multiple identification schemas do exist it will return the default one
     *
     * @return mixed
     */
    function getId();

    /**
     * Add a asset to the collection
     *
     * @param mixed $asset
     */
    function addAsset($asset);

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
     * Add a collection of assets
     *
     * @param array $assets
     */
    function mergeAssets($assets);

    /**
     * Remove an asset from the collection
     *
     * @param mixed $asset
     */
    function removeAsset($asset);

    /**
     * Set a collection of assets
     *
     * @param array $assets
     */
    function setAssets($assets);

    /**
     *
     */
    function addAttribute(AttributeInterface $attribute);

    /**
     *
     */
    function addAttributes(array $attributes);

    /**
     * Remove all features from the product
     */
    function clearAttributes();

    /**
     * Return the features of the product
     *
     * @return \Vespolina\Entity\Product\AttributeInterface
     */
    function getAttributes();

    /**
     * Set the features of the product to a feature set
     *
     * @param $features
     */
    function setAttributes($features);

    /**
     * Add an brand to the product.
     *
     * @param \Vespolina\Entity\Brand\BrandInterface $brand
     * @return $this
     */
    function addBrand(BrandInterface $brand);

    /**
     * Remove the Brands from the product
     *
     * @return $this
     */
    function clearBrands();

    /**
     * Return the Brands
     *
     * @return array of \Vespolina\Entity\Brand\BrandInterface
     */
    function getBrands();

    /**
     * Merge an array of Brands with the existing Brands
     *
     * @param array $brands
     * @return $this
     */
    function mergeBrands(array $brands);

    /**
     * Remove an Brand from the existing Brands
     *
     * @param \Vespolina\Entity\Brand\BrandInterface $brand
     * @return $this
     */
    function removeBrand(BrandInterface $brand);

    /**
     * Set the Brands to the Brands in the array
     *
     * @param array $brands
     * @return $this
     */
    function setBrands(array $brands);

    /**
     * Add an identifier to the product.
     *
     * @param \Vespolina\Entity\Identifier\IdentifierInterface $identifier
     * @return $this
     */
    function addIdentifier(IdentifierInterface $identifier);

    /**
     * Remove the Identifiers from the product
     *
     * @return $this
     */
    function clearIdentifiers();

    /**
     * Return the Identifiers
     *
     * @return array of \Vespolina\Entity\Identifier\IdentifierInterface
     */
    function getIdentifiers();

    /**
     * Merge an array of Identifiers with the existing Identifiers
     *
     * @param array $identifiers
     * @return $this
     */
    function mergeIdentifiers(array $identifiers);

    /**
     * Remove an Identifier from the existing Identifiers
     *
     * @param \Vespolina\Entity\Identifier\IdentifierInterface $identifier
     * @return $this
     */
    function removeIdentifier(IdentifierInterface $identifier);

    /**
     * Set the Identifiers to the Identifiers in the array
     *
     * @param array $identifiers
     * @return $this
     */
    function setIdentifiers(array $identifiers);

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
     * Remove an options type from the product
     *
     * @param string
     */
    function removeOptionType($type);

    /**
     * Set the options of the product to an option set
     *
     * @param array
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
     * Add a taxonomy to the collection
     *
     * @param TaxonomyNodeInterface $taxonomy
     */
    function addTaxonomy(TaxonomyNodeInterface $taxonomy);

    /**
     * Add a collection of taxonomies
     *
     * @param array $taxonomies
     */
    function addTaxonomies(array $taxonomies);

    /**
     * Remove all taxonomies from the collection
     */
    function clearTaxonomies();

    /**
     * Return a specific taxonomy from the collection
     *
     * @param $name
     */
    function getTaxonomy($name);

    /**
     * Return a collection of taxonomies
     *
     * @return array of taxonomies
     */
    function getTaxonomies();

    /**
     * Remove a taxonomy from the collection
     *
     * @param TaxonomyNodeInterface $taxonomy
     */
    function removeTaxonomy(TaxonomyNodeInterface $taxonomy);

    /**
     * Set a collection of taxonomies
     *
     * @param array $taxonomies
     */
    function setTaxonomies(array $taxonomies);

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
     *
     * @return string
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
     * @param \DateTime $createdAt
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
     * @param \DateTime $updatedAt
     */
    function setUpdatedAt(\DateTime $updatedAt);
}
