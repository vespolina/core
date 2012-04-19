<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace  Vespolina\Entity\Identifier;

use Vespolina\Entity\BaseIdentifier;

/**
 * @author Richard D Shank <develop@zestic.com>
 */
class SKUIdentifier extends BaseIdentifier
{
    public function getName()
    {
        return 'sku';
    }
}
