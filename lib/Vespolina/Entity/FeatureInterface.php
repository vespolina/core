<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\Entity;

/**
 * @author Richard D Shank <develop@zestic.com>
 */
interface FeatureInterface
{
    /**
     * Set the name of this feature. ie: Sling Blade, Miramax, R
     *
     * @param $name
     */
    function setName($name);

    /**
     * Get the name of this feature
     *
     * @return string name of node
     */
    function getName();

    /**
     * Set the search term for this feature
     *
     * @param $term
     */
    function setSearchTerm($term);

    /**
     * Return the search term for this feature
     *
     * @return string term
     */
    function getSearchTerm();

    /**
     * Set the type of feature. ie: title, studio, rated
     *
     * @param $type
     */
    function setType($type);

    /**
     * Return the type of feature
     *
     * @return string type
     */
    function getType();
}
