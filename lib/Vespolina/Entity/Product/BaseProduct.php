<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Product;

use Doctrine\Common\Collections\ArrayCollection;
use Vespolina\Entity\Asset\MediaInterface;
use Vespolina\Entity\Brand\BrandInterface;
use Vespolina\Entity\Identifier\IdentifierInterface;
use Vespolina\Entity\Product\BaseProductInterface;
use Vespolina\Entity\Product\OptionInterface;
use Vespolina\Entity\Product\OptionGroupInterface;
use Vespolina\Entity\Taxonomy\TaxonomyNodeInterface;

/**
 * @author Richard D Shank <richard@vespolina.org>
 * @author Daniel Kucharski <daniel@vespolina.org>
 */
abstract class BaseProduct implements BaseProductInterface
{
    const PHYSICAL      = 1;
    const UNIQUE        = 2;
    const DOWNLOAD      = 4;
    const TIME          = 8;
    const SERVICE       = 16;

    protected $assets;
    protected $attributes;
    protected $brands;
    protected $createdAt;
    protected $descriptions;
    protected $identifiers;
    protected $media;
    protected $name;
    protected $optionGroups;
    protected $parent;
    protected $prices;
    protected $taxonomies;
    protected $type;
    protected $updatedAt;
    protected $variations;
    protected $id;

    public function __construct()
    {
        $this->brands = array();
        $this->descriptions = array();
        $this->prices = array();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function addAttribute(AttributeInterface $attribute)
    {
        $type = $attribute->getType();
        $this->attributes[$type] = $attribute;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addAttributes(array $attributes)
    {
        foreach($attributes as $attribute) {
            $this->addAttribute($attribute);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function clearAttributes()
    {
        $this->attributes = array();

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getAttribute($type)
    {
        if (isset($this->attributes[$type])) {
            return $this->attributes[$type];
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @inheritdoc
     */
    function removeAttribute($attribute)
    {
        if ($attribute instanceof AttributeInterface) {
            $attribute = $attribute->getType();
        }
        unset($this->attributes[$attribute]);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setAttributes($attributes)
    {
        $this->attributes = array();
        foreach ($attributes as $attribute) {
            $this->addAttribute($attribute);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addBrand(BrandInterface $brand)
    {
        $this->brands[] = $brand;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function clearBrands()
    {
        foreach ($this->brands as $key => $brand) {
            unset($this->brands[$key]);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBrands()
    {
        return $this->brands;
    }

    /**
     * {@inheritdoc}
     */
    public function mergeBrands(array $brands)
    {
        foreach ($brands as $brand) {
            $this->addBrand($brand);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeBrand(BrandInterface $brand)
    {
        foreach ($this->brands as $key => $curBrand) {
            if ($brand == $curBrand) {
                unset($this->brands[$key]);

                return $this;
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setBrands(array $brands)
    {
        $this->clearBrands();
        foreach ($brands as $brand) {
            $this->addBrand($brand);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setDescription($description, $type = 'default')
    {
        $this->descriptions[$type] = $description;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getDescription($type = 'default')
    {
        if (null !== $this->descriptions) {
            if (array_key_exists($type, $this->descriptions)) {
                return $this->descriptions[$type];
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function addIdentifier(IdentifierInterface $identifier)
    {
        $this->identifiers[] = $identifier;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function clearIdentifiers()
    {
        foreach ($this->identifiers as $key => $identifier) {
            unset($this->identifiers[$key]);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifiers()
    {
        return $this->identifiers;
    }

    /**
     * {@inheritdoc}
     */
    public function mergeIdentifiers(array $identifiers)
    {
        foreach ($identifiers as $identifier) {
            $this->addIdentifier($identifier);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeIdentifier(IdentifierInterface $identifier)
    {
        foreach ($this->identifiers as $key => $curIdentifier) {
            if ($identifier == $curIdentifier) {
                unset($this->identifiers[$key]);

                return $this;
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setIdentifiers(array $identifiers)
    {
        $this->clearIdentifiers();
        foreach ($identifiers as $identifier) {
            $this->addIdentifier($identifier);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
    public function removeOptionGroup($group)
    {
        if ($group instanceof OptionGroupInterface) {
            $group = $group->getName();
        }
        foreach ($this->options as $key => $option) {
            if ($option->getName() == $group) {
                $this->options->remove($key);
                $this->identifiers = new ArrayCollection();

                return $this;
            }
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setOptions($optionGroups)
    {
        $this->clearOptions();
        $this->options = new ArrayCollection;
        foreach ($optionGroups as $optionGroup) {
            $this->options->add($optionGroup);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function clearOptions()
    {
       $this->options = array();
       $this->identifiers = array();

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param $prices
     * @return $this
     */
    public function setPrices($prices)
    {
        $this->prices = $prices;

        return $this;
    }

    /**
     * @return array
     */
    public function getPrices()
    {
        return (array) $this->prices;
    }

    /**
     * @param $value
     * @param $type
     * @return $this
     */
    public function setPrice($value, $type = 'unit')
    {
        foreach ($this->prices as $key => $price) {
            if ($price['type'] == $type) {
                $this->prices[$key] = ['type' => $type, 'value' => $value];

                return $this;
            }
        }
        $this->prices[] = ['type' => $type, 'value' => $value];

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice($type = 'unit')
    {
        foreach ($this->prices as $price) {
            if ($price['type'] == $type) {
                return $price['value'];
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function addMedia(MediaInterface $media)
    {
        $this->media[] = $media;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addMediaCollection(array $media)
    {
        $this->media = array_merge($this->media, $media);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function clearMedia()
    {
        $this->media = array();

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getAllMedia()
    {
        return $this->media;
    }

    /**
     * @inheritdoc
     */
    public function removeMedia(MediaInterface $media)
    {
        foreach ($this->media as $key => $mediaToCompare) {
            if ($mediaToCompare == $media) {
                unset($this->media[$key]);
                break;
            }

        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setMedia(array $media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addTaxonomy(TaxonomyNodeInterface $taxonomy)
    {
        $this->taxonomies[] = $taxonomy;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addTaxonomies(array $taxonomies)
    {
        $this->taxonomies = array_merge($this->taxonomies, $taxonomies);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function clearTaxonomies()
    {
        $this->taxonomies = array();

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTaxonomy($name)
    {


        return null;
    }

    /**
     * @inheritdoc
     */
    public function getTaxonomies()
    {
        return $this->taxonomies;
    }

    /**
     * @inheritdoc
     */
    public function removeTaxonomy(TaxonomyNodeInterface $taxonomy)
    {
        foreach ($this->taxonomies as $key => $taxonomyToCompare) {
            if ($taxonomyToCompare == $taxonomy) {
                unset($this->taxonomies[$key]);
                break;
            }
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setTaxonomies(array $taxonomies)
    {
        $this->taxonomies = $taxonomies;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Return the variations
     *
     * @return mixed
     */
    public function getVariations()
    {
        return $this->variations;
    }

    public function hasVariations()
    {
        return (bool) count($this->variations);
    }

    public function useVariation($label)
    {
        if (!isset($this->variations[$label])) {
            $class = get_class($this);
            $this->variations[$label] = new $class();
        }

        return $this->variations[$label];
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
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

        return $this;
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

        return $this;
    }

    public function autoSetCreatedAt()
    {
        if (null === $this->createdAt) {
            $this->createdAt = new \DateTime();
        }
        $this->autoSetUpdatedAt();

        return $this;
    }

    public function autoSetUpdatedAt()
    {
        $this->updatedAt = new \DateTime();

        return $this;
    }
}
