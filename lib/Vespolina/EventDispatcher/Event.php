<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\EventDispatcher;

use Vespolina\EventDispatcher\EventInterface;

class Event implements EventInterface
{
    protected $name;
    protected $subject;

    public function __construct($subject)
    {
        $this->subject = $subject;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSubject()
    {
        return $this->subject;
    }
}
