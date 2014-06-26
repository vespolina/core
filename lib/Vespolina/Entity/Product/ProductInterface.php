<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Product;

use Vespolina\Entity\Identifier\IdentifierInterface;
use Vespolina\Entity\Product\BaseProductInterface;
use Vespolina\Entity\Product\AttributeInterface;
use Vespolina\Entity\Product\OptionInterface;
use Vespolina\Entity\Product\OptionGroupInterface;

/**
 * @author Richard D Shank <richard@vespolina.org>
 * @author Daniel Kucharski <daniel@vespolina.org>
 */
interface ProductInterface extends BaseProductInterface
{
    /**
     * Add a single attribute to the product
     *
     * @param AttributeInterface $attribute
     */
    function addAttribute(AttributeInterface $attribute);

    /**
     * Add an array of attribute to the product
     * @param array $attributes
     */
    function addAttributes(array $attributes);

    /**
     * Returns true when the product is equal to the product as parameter
     *
     * @param ProductInterface $product
     * @return boolean
     */
    function equals(ProductInterface $product);

    /**
     * Return a attribute by its type
     *
     * @param $type
     *
     * @return \Vespolina\Entity\Product\AttributeInterface
     */
    function getAttribute($type);

    /**
     * Remove a attribute by its type
     *
     * @param $type
     */
    function removeAttribute($type);

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
}
