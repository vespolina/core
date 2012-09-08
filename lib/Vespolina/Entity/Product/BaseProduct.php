<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Product;

use Vespolina\Entity\Identifier\IdentifierInterface;
use Vespolina\Entity\Product\BaseProductInterface;
use Vespolina\Entity\Product\OptionInterface;
use Vespolina\Entity\Product\OptionGroupInterface;

/**
 * @author Richard D Shank <develop@zestic.com>
 * @author Daniel Kucharski <daniel@xerias.be>
 */
abstract class BaseProduct implements BaseProductInterface
{
    const PHYSICAL      = 1;
    const UNIQUE        = 2;
    const DOWNLOAD      = 4;
    const TIME          = 8;
    const SERVICE       = 16;

    protected $description;
    protected $features;
    protected $media;
    protected $name;
    protected $optionGroups;
    protected $type;

    /**
     * @inheritdoc
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @inheritdoc
     */
    public function clearFeatures()
    {
        $this->features = array();
    }

    /**
     * @inheritdoc
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * @inheritdoc
     */
    public function setFeatures($features)
    {
        $this->features = array();
        foreach ($features as $feature) {
            $this->addFeature($feature);
        }
    }

    /**
     * @inheritdoc
     */
    public function addIdentifierSet($index, $identifierSet)
    {
        $this->identifierSets[$index] = $identifierSet;
    }

    /**
     * @inheritdoc
     */
    public function getIdentifiers()
    {
        return $this->identifierSets;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
/** remove for now to get feature tests to pass
    public function addOptionGroup(OptionGroupInterface $optionGroup)
    {
        $this->options[] = $optionGroup;
        $this->identifiers = array();
        $this->processIdentifiers();
    }
*/
    /**
     * @inheritdoc
     */
    public function removeOptionGroup($group)
    {
        if ($group instanceof OptionGroupInterface) {
            $group = $group->getName();
        }
        foreach ($this->options as $key => $option) {
            if ($option->getName() == $group) {
                $this->options->remove($key);
                $this->identifiers = new ArrayCollection();
                $this->processIdentifiers();
                return;
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function setOptions($optionGroups)
    {
        $identifiers = $this->identifiers;
        $this->clearOptions();
        $this->options = new ArrayCollection;
        foreach ($optionGroups as $optionGroup) {
            $this->options->add($optionGroup);
        }
        $this->identifiers = $identifiers;
        $this->processIdentifiers();
    }

    /**
     * @inheritdoc
     */
    public function clearOptions()
    {
       $this->options = array();
       $this->identifiers = array();
    }

    /**
     * @inheritdoc
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @inheritdoc
     */
    public function getIdentifierSets()
    {
        return $this->identifiers;
    }

    /**
     * @inheritdoc
     */
    public function getIdentifierSet($target = null)
    {
        $key = $target ? $this->createKeyFromOptions($target) : 'primary:primary;';
        return $this->identifiers->get($key);
    }

    /**
     * @inheritdoc
     */
    public function addIdentifier($identifier, $target = null)
    {
        $key = $target ? $target : 'primary:primary;';
        if (is_array($key)) {
            $key = $this->createKeyFromOptions($target);
        }
        if (!$idSet = $this->identifiers->get($key)) {
            $optionGroup = key($target);
            throw new \Exception(sprintf('There is not an option group %s with the option %s', $optionGroup, $target[$optionGroup]));
        }
        $idSet->addIdentifier($identifier);

        $this->processIdentifiers();
    }

    /**
     * @inheritdoc
     */
    public function setType($type)
    {
        $this->type = $type;
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
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @inheritdoc
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @inheritdoc
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @inheritdoc
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function autoSetCreatedAt()
    {
        if (null === $this->createdAt) {
            $this->createdAt = new \DateTime();
        }
        $this->autoSetUpdatedAt();
    }

    public function autoSetUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
    }
}
