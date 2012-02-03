<?php
/**
 * (c) 2011 - 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\CartBundle\Tests\Fixtures\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

use Vespolina\CartBundle\Model\CartableItemInterface;
use Vespolina\ProductBundle\Model\RecurringInterface;
use Vespolina\ProductBundle\Model\RecurInterface;

/**
 * @author Richard Shank <develop@zestic.com>
 */
/**
 * @ODM\Document(collection="vespolina_cartable")
 */
class RecurringCartable extends Cartable implements RecurringInterface
{
    //TODO: RecurringInterface belongs in CartBundle not ProductBundle
    // TODO: should $recur be called Plan?

    protected $recur;

    public function getRecur()
    {
        return $this->recur;
    }

    public function setRecur(RecurInterface $recur)
    {
        $this->recur = $recur;
    }
}
