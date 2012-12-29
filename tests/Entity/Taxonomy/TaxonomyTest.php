<?php

use Vespolina\Entity\Taxonomy\Taxonomy;
use Vespolina\Entity\Taxonomy\Term;

class TaxonomyTest extends \PHPUnit_Framework_TestCase
{
    public function testTerm()
    {
        $taxonomy = new Taxonomy();
        $this->assertNull($taxonomy->getTerms(), 'make sure we start out empty');

        $term = new Term('term');
        $taxonomy->addTerm($term);
        $this->assertContains($term, $taxonomy->getTerms());
        $this->assertCount(1, $taxonomy->getTerms());

        $terms = array();
        $terms[] = new Term('term1');
        $terms[] = new Term('term2');
        $taxonomy->addTerms($terms);
        $this->assertCount(3, $taxonomy->getTerms());
        $this->assertContains($term, $taxonomy->getTerms());

        $taxonomy->removeTerm($term);
        $this->assertNotContains($term, $taxonomy->getTerms());
        $this->assertCount(2, $taxonomy->getTerms());

        $taxonomy->clearTerms();
        $this->assertEmpty($taxonomy->getTerms());

        $taxonomy->addTerm($term);
        $taxonomy->setTerms($terms);
        $this->assertNotContains($term, $taxonomy->getTerms(), 'this should have been removed on setting a new array of items');
        $this->assertCount(2, $taxonomy->getTerms());
    }
}
