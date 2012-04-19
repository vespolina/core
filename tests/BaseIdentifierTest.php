<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Tests;

use Vespolina\Entity\BaseIdentifier;

class BaseIdentifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Vespolina\Entity\Exception\IdentifierCheckDigitException
     */
    public function testSetCodeException()
    {
        $identifier = $this->getMockForAbstractClass('Vespolina\Entity\BaseIdentifier', array(), '', false, false, true, array('checkDigit'));
        $identifier->expects($this->any())
            ->method('checkDigit')
            ->will($this->returnValue(false));

        $identifier->setCode('FA11');
    }
}
