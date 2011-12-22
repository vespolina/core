<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\CartBundle\Document;

use Vespolina\CartBundle\Model\CartItem as AbstractCartItem;
/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
abstract class BaseCartItem extends AbstractCartItem
{

    public function prePersistCartItem()
    {

        if ($this->product) {

            $this->productId = $this->product->getId();
        }
    }
}