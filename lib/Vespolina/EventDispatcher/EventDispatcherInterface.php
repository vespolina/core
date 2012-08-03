<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\EventDispatcher;

use Vespolina\EventDispatcher\EventInterface;

interface EventDispatcherInterface
{
    function createEvent($name, $subject=null);

    function dispatch($eventName, EventInterface $event = null);
}
