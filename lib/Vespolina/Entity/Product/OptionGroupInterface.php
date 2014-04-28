<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Product;

/**
 * @author Richard D Shank <richard@vespolina.org>
 */
interface OptionGroupInterface
{
    /**
     * Add a option to this product options node.
     *
     * @param OptionInterface $option
     */
    public function addOption(OptionInterface $option);

    /**
     * Add an array of OptionInterface objects to the option group
     *
     * @param OptionInterface[] $options
     */
    public function addOptions(array $options);

    /**
     * Clear all options from this product options
     */
    public function clearOptions();

    /**
     * Return a specific option by index
     *
     * @param string $index
     *
     * @return OptionInterface|null
     */
    public function getOption($index);

    /**
     * Return a specific option by the display
     *
     * @param string $display
     *
     * @return OptionInterface|null
     */
    public function getOptionByDisplay($display);

    /**
     * Return a specific option by the name
     *
     * @param string $name
     *
     * @return OptionInterface|null
     */
//    public function getOptionByName($name);

    /**
     * Return all the options for this type
     *
     * @return OptionInterface[]
     */
    public function getOptions();

    /**
     * Add a collection of options
     *
     * @param OptionInterface[]
     */
    public function setOptions($options);

    /**
     * Remove a option from this option group
     *
     * @param OptionInterface $option
     */
    public function removeOption(OptionInterface $option);

    /**
     * Set the type of the option group
     *
     * @param string $type
     */
    public function setType($type);

    /**
     * Return the type of the option group
     *
     * @return string $type
     */
    public function getType();
}
