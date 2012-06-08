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
interface IdentifierInterface
{
    /**
     * Perform a digit check on the identifier code if applicable
     *
     * @param (optional) $code
     * @return boolean
     */
    function checkDigit($code = null);

    /**
     * Set the code for this identifier
     *
     * @param $code
     */
    function setCode($code);

    /**
     * Return the code for this identifier
     *
     * @return code
     */
    function getCode();

    /**
     * Return the name of the identifier
     */
    function getName();
}
