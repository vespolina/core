<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Identifier\BaseIdentifier;

class BaseIdentifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Vespolina\Exception\IdentifierCheckDigitException
     */
    public function testSetCodeException()
    {
        /** @var $identifier \Vespolina\Entity\Identifier\BaseIdentifier */
        $identifier = $this->getMockForAbstractClass('Vespolina\Entity\Identifier\BaseIdentifier', array(), '', false, false, true, array('checkDigit'));
        $identifier->expects($this->any())
            ->method('checkDigit')
            ->will($this->returnValue(false));

        $identifier->setCode('FA11');
    }
}
