<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\CartBundle\Entity;

use Vespolina\CartBundle\Model\Option\Option as AbstractOption;
/**
 * @author Richard D Shank <develop@zestic.com>
 */
class Option extends AbstractOption
{
    protected $cartItem;
    protected $id;

}
