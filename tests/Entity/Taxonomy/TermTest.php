<?php

use Vespolina\Entity\Taxonomy\Term;

class TestTerm extends \PHPUnit_Framework_TestCase
{
    public function testChildren()
    {
        $rootTerm = new Term('root');
        $this->assertNull($rootTerm->getChildren(), 'make sure we start out empty');

        $child = new Term('child');
        $rootTerm->addChild($child);
        $this->assertContains($child, $rootTerm->getChildren());
        $this->assertCount(1, $rootTerm->getChildren());
        $this->assertSame($rootTerm, $child->getParent());

        $children = array();
        $children[0] = new Term('child0');
        $children[1] = new Term('child1');
        $rootTerm->addChildren($children);
        $this->assertCount(3, $rootTerm->getChildren());
        $this->assertContains($children[0], $rootTerm->getChildren());
        $this->assertContains($children[1], $rootTerm->getChildren());
        $this->assertSame($rootTerm, $children[0]->getParent());
        $this->assertSame($rootTerm, $children[1]->getParent());

        $rootTerm->removeChild($child);
        $this->assertNotContains($child, $rootTerm->getChildren());
        $this->assertCount(2, $rootTerm->getChildren());
        $this->assertNull($child->getParent());

        $rootTerm->clearChildren();
        $this->assertEmpty($rootTerm->getChildren());
        $this->assertNull($children[0]->getParent());
        $this->assertNull($children[1]->getParent());

        $rootTerm->addChild($child);
        $rootTerm->setChildren($children);
        $this->assertNotContains($child, $rootTerm->getChildren(), 'this should have been removed on setting a new array of items');
        $this->assertNull($child->getParent());
        $this->assertCount(2, $rootTerm->getChildren());
        $this->assertContains($children[0], $rootTerm->getChildren());
        $this->assertContains($children[1], $rootTerm->getChildren());
        $this->assertSame($rootTerm, $children[0]->getParent());
        $this->assertSame($rootTerm, $children[1]->getParent());
    }

    public function testAttributeMethods()
    {
        $term = new Term('term');

        $this->assertNull($term->getAttribute('noAttribute'));

        $term->addAttribute('attribute1', 1);
        $this->assertCount(1, $term->getAttributes());
        $this->assertSame(1, $term->getAttribute('attribute1'));

        $term->addAttribute('attribute2', 2);
        $this->assertCount(2, $term->getAttributes());
        $this->assertSame(2, $term->getAttribute('attribute2'));

        $term->removeAttribute('attribute2');
        $this->assertCount(1, $term->getAttributes(), 'remove by attribute');
        $this->assertNull($term->getAttribute('attribute2'));

        $attributes = array(
            'attribute2' => 2,
            'attribute3' => 3
        );

        $term->addAttributes($attributes);
        $this->assertCount(3, $term->getAttributes());
        $this->assertSame(2, $term->getAttribute('attribute2'));
        $this->assertSame(3, $term->getAttribute('attribute3'));

        $term->setAttributes($attributes);
        $this->assertCount(2, $term->getAttributes());
        $this->assertNull($term->getAttribute('attribute1'));
        $this->assertSame(2, $term->getAttribute('attribute2'));
        $this->assertSame(3, $term->getAttribute('attribute3'));

        $term->removeAttribute('attribute3');
        $this->assertCount(1, $term->getAttributes(), 'attribute should be removed by type');
        $term->removeAttribute('nada');
        $this->assertCount(1, $term->getAttributes());

        $term->clearAttributes();
        $this->assertEmpty($term->getAttributes());
    }
}
