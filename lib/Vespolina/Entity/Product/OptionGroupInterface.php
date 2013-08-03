<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Product;

/**
 * @author Richard D Shank <develop@zestic.com>
 */
interface OptionGroupInterface
{
    /**
     * Add a option to this product options node.
     *
     * @param Vespolina\Entity\Product\OptionInterface $option
     */
    function addOption(OptionInterface $option);

    /**
     * Add an array of OptionInterface objects to the option group
     *
     * @param array $options
     */
    function addOptions(array $options);

    /**
     * Clear all options from this product options
     */
    function clearOptions();

    /**
     * Return a specific option by value
     *
     * @param string $value
     *
     * @return Vespolina\Entity\Product\OptionInterface
     */
    function getOption($value);

    /**
     * Return a specific option by the name
     *
     * @param string $display
     *
     * @return Vespolina\Entity\Product\OptionInterface or null
     */
    function getOptionByDisplay($display);

    /**
     * Return all the options for this type
     *
     * @return array of Vespolina\Entity\Product\OptionInterface
     */
    function getOptions();

    /**
     * Add a collection of options
     *
     * @param array $options
     */
    function setOptions($options);

    /**
     * Remove a option from this product options set
     *
     * @param Vespolina\Entity\Product\OptionInterface $option
     */
    function removeOption(OptionInterface $option);

    /**
     * Set the name of the option group
     *
     * @param string $name
     */
    function setName($name);

    /**
     * Return the name of the option group
     *
     * @return string $name
     */
    function getName();
}
