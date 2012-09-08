<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Asset;

use Vespolina\Entity\Asset\AssetInterface;

/**
 * @author Myke Hines <myke@webhines.com>
 */
class Asset implements AssetInterface
{
    protected $id;
    protected $label;
    protected $priority;
    protected $fileName;
    protected $height;
    protected $width;
    protected $mime;
    protected $type;

    /**
     * Set the asset label
     *
     * @param $label
     */
    function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * Get the asset label.
     * @return label
     */
    function getLabel()
    {
        return $this->label;
    }


    /**
     * Set the asset priority
     *
     * @param $priority
     */
    function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * Get the asset priority.
     * @return priority
     */
    function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set the asset filename
     *
     * @param $fileName
     */
    function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * Get the asset file name.
     *
     * @return fileName
     */
    function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set the asset height
     *
     * @param $height
     */
    function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * Get the asset height.
     * @return height
     */
    function getHeight()
    {
        return $this->height;
    }

    /**
     * Set the asset width
     *
     * @param $width
     */
    function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * Get the asset width.
     * @return width
     */
    function getWidth()
    {
        return $this->width;
    }

    /**
     * Set the asset mime
     *
     * @param $mime
     */
    function setMime($mime)
    {
        $this->mime = $mime;
    }

    /**
     * Get the asset mime.
     * @return mime
     */
    function getMime()
    {
        return $this->mime;
    }

    /**
     * Set the asset type
     *
     * @param $type
     */
    function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get the asset type.
     * @return type
     */
    function getType()
    {
        return $this->type;
    }
}
