<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.12.2
 * Time: 12.18
 */

namespace AppBundle\Entity;

class MenuChild
{
    private $title;
    private $slugName;
    private $slugValue;

    /**
     * MenuChild constructor.
     * @param $title
     * @param $slugName
     * @param $slugValue
     */
    public function __construct($title, $slugName, $slugValue)
    {
        $this->title = $title;
        $this->slugName = $slugName;
        $this->slugValue = $slugValue;
    }

    /**
     * @return mixed
     */
    public function getSlugValue()
    {
        return $this->slugValue;
    }

    /**
     * @param mixed $slugValue
     */
    public function setSlugValue($slugValue)
    {
        $this->slugValue = $slugValue;
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
    public function getSlugName()
    {
        return $this->slugName;
    }

    /**
     * @param mixed $slugName
     */
    public function setSlugName($slugName)
    {
        $this->slugName = $slugName;
    }
}
