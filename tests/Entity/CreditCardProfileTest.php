<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\CreditCardProfile;

/**
 * @author Richard D Shank <develop@zestic.com>
 */
class CreditCardProfileTest extends \PHPUnit_Framework_TestCase
{
    public function testSetCardNumber()
    {
        $profile = $this->getMockForAbstractClass('Vespolina\Entity\CreditCardProfile');
        $profile->setCardNumber('1234A 4567-8901.1235');

        $activeCardNumber = new \ReflectionProperty($profile, 'activeCardNumber');
        $activeCardNumber->setAccessible(true);
        $this->assertSame('1234456789011235', $activeCardNumber->getValue($profile), 'all non numeric number should be removed');

        $persistedCardNumber = new \ReflectionProperty($profile, 'persistedCardNumber');
        $persistedCardNumber->setAccessible(true);
        $this->assertSame('************1235', $persistedCardNumber->getValue($profile), 'only a hint of the card number should be presisted');

        $profile->setCardNumber('305.693.0902.5904');
        $this->assertSame('**********5904', $persistedCardNumber->getValue($profile));
    }
}
