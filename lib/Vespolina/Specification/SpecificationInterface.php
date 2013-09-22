<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Specification;

/**
 * Interface to construct entity queries
 *
 * @author Daniel Kucharski <daniel@vespolina.org>
 */
interface SpecificationInterface
{
   function isSatisfiedBy($entity);
}