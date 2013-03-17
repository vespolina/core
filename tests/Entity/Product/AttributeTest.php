<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Product\Attribute;

class AttributeTest extends \PHPUnit_Framework_TestCase
{
    public function testSetSearchTerm()
    {
        $feature = new Attribute();
        $feature->setSearchTerm('MIxEd cAsE');
        $this->assertSame('mixed case', $feature->getSearchTerm(), 'the search term should be converted to lower case before setting');

        $titleAttribute = new Attribute();
        $titleAttribute->setType('title');
        $titleAttribute->setName('EIGHT53');

        $this->assertEquals(
            'eight53',
            $titleAttribute->getSearchTerm(),
            'the search term should be a lowercase version of the name'
        );

        $titleAttribute->setSearchTerm('different search term');
        $this->assertEquals(
            'different search term',
            $titleAttribute->getSearchTerm(),
            'setting search term overrides previous set term'
        );

        $titleAttribute->setName('eight53');
        $this->assertEquals(
            'different search term',
            $titleAttribute->getSearchTerm(),
            'if a term is already set, it should not be overwritten by setting the name'
        );

        $titleAttribute->setSearchTerm(21);
        $this->assertInternalType('string', $titleAttribute->getSearchTerm(), 'make sure the search is type cast as a string');
    }
}
