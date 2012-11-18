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
class Term implements TermInterface
{
    protected $attributes;
    protected $children;
    protected $name;
    protected $path;
    protected $parent;

    public function __construct($name)
    {
        $this->name = $name;
    }


    /**
     * @inheritdoc
     */
    public function addAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    /**
     * @inheritdoc
     */
    public function addAttributes(array $attributes)
    {
        $this->attributes = array_merge($this->attributes, $attributes);
    }

    /**
     * @inheritdoc
     */
    public function clearAttributes()
    {
        $this->attributes = array();
    }

    /**
     * @inheritdoc
     */
    public function getAttribute($name)
    {
        if (isset($this->attributes[$name])) {

            return $this->attributes[$name];
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
    public function removeAttribute($name)
    {
        unset($this->attributes[$name]);
    }

    /**
     * @inheritdoc
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @inheritdoc
     */
    public function addChild(TermInterface $term)
    {
        $this->children[] = $term;
        $rc = new \ReflectionProperty($term, 'parent');
        $rc->setAccessible(true);
        $rc->setValue($term, $this);
        $rc->setAccessible(false);
    }

    /**
     * @inheritdoc
     */
    public function addChildren(array $terms)
    {
        foreach ($terms as $term) {
            $this->addChild($term);
        }
    }

    /**
     * @inheritdoc
     */
    public function clearChildren()
    {
        $rc = new \ReflectionProperty($this, 'parent');
        $rc->setAccessible(true);

        foreach ($this->children as $term) {
            $rc->setValue($term, null);
        }
        $rc->setAccessible(false);

        $this->children = array();
    }

    /**
     * @inheritdoc
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @inheritdoc
     */
    public function removeChild(TermInterface $term)
    {
        foreach ($this->children as $key => $termToCompare) {
            if ($termToCompare == $term) {
                unset($this->children[$key]);
                $rc = new \ReflectionProperty($term, 'parent');
                $rc->setAccessible(true);
                $rc->setValue($term, null);
                $rc->setAccessible(false);

                return;
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function setChildren(array $terms)
    {
        $this->clearChildren();
        $this->addChildren($terms);
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
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @inheritdoc
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @inheritdoc
     */
    public function getParent()
    {
        return $this->parent;
    }
}