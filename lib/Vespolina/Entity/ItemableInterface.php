<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity;

/**
 * Interface to tie items to order and invoices
 *
 * @author Luis Cordova <cordoval@gmail.com>
 */
interface ItemableInterface
{
    function addItem($item);
    function removeItem($item);
}