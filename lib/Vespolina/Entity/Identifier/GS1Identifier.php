<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Identifier;

use Vespolina\Entity\Identifier\BaseIdentifier;

/**
 * @author Richard D Shank <richard@vespolina.org>
 */
abstract class GS1Identifier extends BaseIdentifier
{
    /**
     * Performs a redundancy check on the identifier code, needs to be overridden
     *
     * @return boolean
     */
    public function checkDigit($code = null)
    {
        return false;
    }

    /**
     * Performs a redundancy check on GTIN-8 codes
     *
     * @param $code
     * @return boolean
     */
    protected function checkDigitGTIN8($code)
    {

    }

    /**
     * Performs a redundancy check on GTIN-12 codes
     *
     * @param $code
     * @return boolean
     */
    protected function checkDigitGTIN12($code)
    {

    }

    /**
     * Performs a redundancy check on GTIN-13 codes
     *
     * @param $code
     * @return boolean
     */
    protected function checkDigitGTIN13($code)
    {

    }

    /**
     * Performs a redundancy check on GTIN-14 codes
     *
     * @param $code
     * @return boolean
     */
    protected function checkDigitGTIN14($code)
    {

    }

    /**
     * Performs a redundancy check on GTIN-8 codes
     *
     * @param $code
     * @return boolean
     */
    protected function checkDigitSSCC($code)
    {

    }
}
