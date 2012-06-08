<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Feature;

class FeatureTest extends \PHPUnit_Framework_TestCase
{
    public function testSetSearchTerm()
    {
        $feature = new Feature();
        $feature->setSearchTerm('MIxEd cAsE');
        $this->assertSame('mixed case', $feature->getSearchTerm(), 'the search term should be converted to lower case before setting');

        $titleFeature = new Feature();
        $titleFeature->setType('title');
        $titleFeature->setName('EIGHT53');

        $this->assertEquals(
            'eight53',
            $titleFeature->getSearchTerm(),
            'the search term should be a lowercase version of the name'
        );

        $titleFeature->setSearchTerm('different search term');
        $this->assertEquals(
            'different search term',
            $titleFeature->getSearchTerm(),
            'setting search term overrides previous set term'
        );

        $titleFeature->setName('eight53');
        $this->assertEquals(
            'different search term',
            $titleFeature->getSearchTerm(),
            'if a term is already set, it should not be overwritten by setting the name'
        );

        $titleFeature->setSearchTerm(21);
        $this->assertInternalType('string', $titleFeature->getSearchTerm(), 'make sure the search is type cast as a string');
    }
}
