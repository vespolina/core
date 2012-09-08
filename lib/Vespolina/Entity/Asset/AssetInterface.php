<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Asset;

/**
 * @author Richard D Shank <develop@zestic.com>
 * @author Daniel Kucharski <daniel@xerias.be>
 */
interface AssetInterface
{
    /**
     * Set the asset label
     *
     * @param $label
     */
    function setLabel($label);

    /**
     * Get the asset label.
     * @return label
     */
    function getLabel();

    /**
     * Set the asset priority
     *
     * @param $priority
     */
    function setPriority($priority);

    /**
     * Get the asset priority.
     * @return priority
     */
    function getPriority();

    /**
     * Set the asset file name
     *
     * @param $fileName
     */
    function setFileName($fileName);

    /**
     * Get the asset file name.
     * @return fileName
     */
    function getFileName();

    /**
     * Set the asset height
     *
     * @param $height
     */
    function setHeight($height);

    /**
     * Get the asset height.
     * @return height
     */
    function getHeight();

    /**
     * Set the asset width
     *
     * @param $width
     */
    function setWidth($width);

    /**
     * Get the asset width.
     * @return width
     */
    function getWidth();

    /**
     * Set the asset mime
     *
     * @param $mime
     */
    function setMime($mime);

    /**
     * Get the asset mime.
     * @return mime
     */
    function getMime();

    /**
     * Set the asset type
     *
     * @param $type
     */
    function setType($type);

    /**
     * Get the asset type.
     * @return type
     */
    function getType();
}
