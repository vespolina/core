<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\Entity\Identifier;

use Vespolina\Entity\Identifier\GS1Identifier;

/**
 * @author Richard D Shank <develop@zestic.com>
 */
class EANIdentifier extends GS1Identifier
{
    /**
     * Performs a redundancy check on the identifier code
     *
     * @return boolean
     */
    public function checkDigit($code = null)
    {
        return false;
    }

    public function getName()
    {
        return 'ean';
    }
}
