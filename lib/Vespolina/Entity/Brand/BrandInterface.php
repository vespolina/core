<?php

namespace Vespolina\Entity\Brand;

interface BrandInterface 
{
    /**
     * Set the description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description);

    /**
     * Return the description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set the logo
     *
     * @param mixed $logo
     * @return $this
     */
    public function setLogo($logo);

    /**
     * Return the logo
     *
     * @return mixed
     */
    public function getLogo();

    /**
     * Set the name of the Brand
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Return the name of the Brand
     *
     * @return string
     */
    public function getName();

    /**
     * Set the slug
     *
     * @param mixed $slug
     * @return $this
     */
    public function setSlug($slug);

    /**
     * Return the slug
     *
     * @return mixed
     */
    public function getSlug();

    /**
     * Set the uri
     *
     * @param string $uri
     * @return $this
     */
    public function setUri($uri);

    /**
     * Return the uri
     *
     * @return string
     */
    public function getUri();
} 