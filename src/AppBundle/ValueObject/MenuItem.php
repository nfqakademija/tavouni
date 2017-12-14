<?php

namespace AppBundle\ValueObject;

class MenuItem
{
    /**
     * @var string
     */
    private $route;

    /**
     * @var string
     */
    private $title;

    /**
     * @var array
     */
    private $children;

    /**
     * MenuItem constructor.
     * @param $route
     * @param $title
     * @param $children
     */
    public function __construct(string $route, string $title, array $children = [])
    {
        $this->route = $route;
        $this->title = $title;
        $this->children = $children;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @param string $route
     */
    public function setRoute(string $route)
    {
        $this->route = $route;
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
     * @return array
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @param array $children
     */
    public function setChildren(array $children)
    {
        $this->children = $children;
    }
}
