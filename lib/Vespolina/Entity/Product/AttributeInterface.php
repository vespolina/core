<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\Entity\Product;

/**
 * @author Richard D Shank <develop@zestic.com>
 */
interface AttributeInterface
{
    /**
     * Set the name of this attribute. ie: Sling Blade, Miramax, R
     *
     * @param $name
     */
    function setName($name);

    /**
     * Get the name of this attribute
     *
     * @return string
     */
    function getName();

    /**
     * Set the search term for this attribute
     *
     * @param $term
     */
    function setSearchTerm($term);

    /**
     * Return the search term for this attribute
     *
     * @return string
     */
    function getSearchTerm();

    /**
     * Set the type of attribute. ie: title, studio, rated
     *
     * @param $type
     */
    function setType($type);

    /**
     * Return the type of attribute
     *
     * @return string
     */
    function getType();
}
