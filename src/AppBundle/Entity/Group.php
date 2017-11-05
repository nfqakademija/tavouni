<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Group
 *
 * @ORM\Table(name="groups")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GroupRepository")
 */
class Group
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="groupType", type="string", length=255)
     */
    private $groupType;

    /**
     * @var int
     *
     * @ORM\Column(name="groupNo", type="integer")
     */
    private $groupNo;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Group", mappedBy="group")
     */
    private $lectures;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Group", mappedBy="students")
     */
    private $groups;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set groupType
     *
     * @param string $groupType
     *
     * @return Group
     */
    public function setGroupType($groupType)
    {
        $this->groupType = $groupType;

        return $this;
    }

    /**
     * Get groupType
     *
     * @return string
     */
    public function getGroupType()
    {
        return $this->groupType;
    }

    /**
     * Set groupNo
     *
     * @param integer $groupNo
     *
     * @return Group
     */
    public function setGroupNo($groupNo)
    {
        $this->groupNo = $groupNo;

        return $this;
    }

    /**
     * Get groupNo
     *
     * @return int
     */
    public function getGroupNo()
    {
        return $this->groupNo;
    }

    /**
     * @return ArrayCollection
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param ArrayCollection $groups
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;
    }
}
