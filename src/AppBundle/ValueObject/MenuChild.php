<?php

namespace AppBundle\ValueObject;

class MenuChild
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $slugName;

    /**
     * @var string
     */
    private $slugValue;

    /**
     * MenuChild constructor
     *
     * @param string $title
     * @param string $slugName
     * @param string $slugValue
     */
    public function __construct(string $title, string $slugName, string $slugValue)
    {
        $this->title = $title;
        $this->slugName = $slugName;
        $this->slugValue = $slugValue;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSlugName(): string
    {
        return $this->slugName;
    }

    /**
     * @param string $slugName
     */
    public function setSlugName(string $slugName)
    {
        $this->slugName = $slugName;
    }

    /**
     * @return string
     */
    public function getSlugValue(): string
    {
        return $this->slugValue;
    }

    /**
     * @param string $slugValue
     */
    public function setSlugValue(string $slugValue)
    {
        $this->slugValue = $slugValue;
    }
}
