<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\EventDispatcher;

use Vespolina\EventDispatcher\EventInterface;

interface EventDispatcherInterface
{
    /**
     * Create a new Event for the dispatcher system
     *
     * @param null $subject object that is the subject of the event
     *
     * @return instance Vespolina\EventDispatcher\EventInterface
     */
    function createEvent($subject=null);

    /**
     * Dispatches an event to all registered listeners.
     *
     * @param string $eventName The name of the event to dispatch. The name of the event is the name of the method that
     *                          is invoked on listeners.
     * @param \Vespolina\EventDispatcher\EventInterface $event The event to pass to the event handlers/listeners.
     *                          If not supplied, an empty Event instance is created.
     *
     * @return Event
     */
    function dispatch($eventName, EventInterface $event = null);
}
