<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\Entity\Taxonomy;

use Vespolina\Entity\Taxonomy\TermInterface;


/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
interface TaxonomyInterface
{
    /**
     * Add a term to the collection
     *
     * @param TermInterface $term
     */
    function addTerm(TermInterface $term);

    /**
     * Add a collection of terms
     *
     * @param array $terms
     */
    function addTerms(array $terms);

    /**
     * Remove all terms from the collection
     */
    function clearTerms();

    /**
     * Return a collection of terms
     *
     * @return array of terms
     */
    function getTerms();

    /**
     * Remove a term from the collection
     *
     * @param TermInterface $term
     */
    function removeTerm(TermInterface $term);

    /**
     * Set a collection of terms
     *
     * @param array $terms
     */
    function setTerms(array $terms);

    /**
     * Get the taxonomy name
     * eg. Taxonomy_hierarchy
     *
     * @abstract
     * @return string
     */
    function getName();

    /**
     * Retrieve the taxonomy type
     *
     * Possible options are:
     *  - hierarchical
     *  - tags
     *
     * @abstract
     *
     */
    function getType();

    function setName($name);

    function setType($type);
}
