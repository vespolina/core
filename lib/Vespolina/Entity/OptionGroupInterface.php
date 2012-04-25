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
interface OptionGroupInterface
{
    /**
     * Add a option to this product options node.
     *
     * @param Vespolina\Entity\OptionInterface $option
     */
    public function addOption(OptionInterface $option);

    /**
     * Clear all options from this product options
     */
    public function clearOptions();

    /**
     * Return a specific option by value
     *
     * @param string $value
     *
     * @return Vespolina\Entity\OptionInterface
     */
    public function getOption($value);

    /**
     * Return a specific option by the name
     *
     * @param string $display
     *
     * @return Vespolina\Entity\OptionInterface or null
     */
    public function getOptionByDisplay($display);

    /**
     * Return all the options for this type
     *
     * @return array of Vespolina\Entity\OptionInterface
     */
    public function getOptions();

    /**
     * Add a collection of options
     *
     * @param array $options
     */
    public function setOptions($options);

    /**
     * Remove a option from this product options set
     *
     * @param OptionInterface $option
     */
    public function removeOption(OptionInterface $option);

    /**
     * Set the name of the option group
     *
     * @param string $name
     */
    public function setName($name);

    /**
     * Return the name of the option group
     *
     * @return string $name
     */
    public function getName();
}
