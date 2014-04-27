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
interface OptionInterface
{
    /**
     * Set the assigned value for this option. ie, RD, LG
     *
     * @param string $value
     */
    function setValue($value);

    /**
     * Return the option value
     *
     * @return string
     */
    function getValue();

    /**
     * Set the displayed name for this option. ie, red, large
     *
     * @param string $display
     */
    function setDisplay($display);

    /**
     * Return the display name of the option
     *
     * @return string
     */
    function getDisplay();

    /**
     * Set the group type of option. ie color, size It corrisponds with a type in an OptionGroup
     *
     * @param string $type
     */
    function setType($type);

    /**
     * Return the group type of option
     *
     * @return string
     */
    function getType();
}
