<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Taxonomy;

use Vespolina\Entity\Taxonomy\TaxonomyInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
class Taxonomy implements TaxonomyInterface
{
    protected $id;
    protected $isHierarchical;
    protected $name;
    protected $terms;
    protected $type;

    public function __construct($isHierarchical = false)
    {
        $this->isHierarchical = $isHierarchical;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function addTerm(TermInterface $term)
    {
        $this->terms[] = $term;
    }

    /**
     * @inheritdoc
     */
    public function addTerms(array $terms)
    {
        $this->terms = array_merge($this->terms, $terms);
    }

    /**
     * @inheritdoc
     */
    public function clearTerms()
    {
        $this->terms = array();
    }

    /**
     * @inheritdoc
     */
    public function getTerms()
    {
        return $this->terms;
    }

    /**
     * @inheritdoc
     */
    public function removeTerm(TermInterface $term)
    {
        foreach ($this->terms as $key => $termToCompare) {
            if ($termToCompare == $term) {
                unset($this->terms[$key]);
                break;
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function setTerms(array $terms)
    {
        $this->terms = $terms;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return $this->type;
    }

     /**
      * @inheritdoc
      */
    public function setType($type)
    {
        $this->type = $type;
    }

     protected function slugify($text)
     {
         return preg_replace('/[^a-z0-9_\s-]/', '', preg_replace("/[\s_]/", "-", preg_replace('!\s+!', ' ', strtolower(trim($text)))));
     }
}