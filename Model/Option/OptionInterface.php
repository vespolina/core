<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\CartBundle\Model\Option;

/**
 * @author Richard D Shank <develop@zestic.com>
 */
interface OptionInterface
{
    /**
     * Set the assigned value for this option. ie, RD, LG
     *
     * @param string $value
     */
    public function setValue($value);

    /**
     * Return the option value
     *
     * @return string
     */
    public function getValue();

    /**
     * Set the group type of option. ie color, size
     *
     * @param string $type
     */
    public function setType($type);

    /**
     * Return the group type of option
     *
     * @return string
     */
    public function getType();
}
