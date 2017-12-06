<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.12.2
 * Time: 01.18
 */

namespace AppBundle\Entity;

class MenuItem
{
    private $route;
    private $title;
    private $children;

    /**
     * MenuItem constructor.
     * @param $route
     * @param $title
     * @param $children
     */
    public function __construct($route, $title, $children = [])
    {
        $this->route = $route;
        $this->title = $title;
        $this->children = $children;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param mixed $children
     */
    public function setChildren($children)
    {
        $this->children = $children;
    }
}
