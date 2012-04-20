<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Tests;

use Vespolina\Entity\Feature;

class FeatureTest extends \PHPUnit_Framework_TestCase
{
    public function testSetSearchTerm()
    {
        $feature = new Feature();
        $feature->setSearchTerm('MIxEd cAsE');
        $this->assertSame('mixed case', $feature->getSearchTerm(), 'the search term should be converted to lower case before setting');
    }
}
