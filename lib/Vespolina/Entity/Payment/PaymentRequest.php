<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Payment;

class PaymentRequest implements \ArrayAccess, \IteratorAggregate, PaymentRequestInterface
{
    protected $attributes = array();

    protected $id;

    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function offsetExists($offset)
{
    return array_key_exists($offset, $this->attributes);
}

    /**
     * {@inheritDoc}
     */
    public function offsetGet($offset)
{
    return $this->attributes[$offset];
}

    /**
     * {@inheritDoc}
     */
    public function offsetSet($offset, $value)
{
    $this->attributes[$offset] = $value;
}

    /**
     * {@inheritDoc}
     */
    public function offsetUnset($offset)
{
    unset($this->attributes[$offset]);
}

    /**
     * {@inheritDoc}
     */
    public function getIterator()
{
    return new \ArrayIterator($this->attributes);
}

}
