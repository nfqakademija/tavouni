<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="students")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StudentRepository")
 */
class Student
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
     * @var User
     *
     * @ORM\OneToOne(targetEntity="User", inversedBy="student")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="students")
     * @ORM\JoinTable(name="groups_students")
     */
    private $groups;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Grade", mappedBy="student")
     */
    private $grades;

    /**
     * @param User $user
     * @param string $name
     */
    public function __construct(User $user, $name)
    {
        $this->user = $user;
        $this->name = $name;
        $this->groups = new ArrayCollection();
        $this->grades = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $name
     *
     * @return Student
     */
    public function setName(string $name): Student
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return ArrayCollection
     */
    public function getGroups(): ArrayCollection
    {
        return $this->groups;
    }

    /**
     * @param Group $group
     *
     * @return Student
     */
    public function addGroup(Group $group): Student
    {
        $this->groups[] = $group;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return Student
     */
    public function setUser($user): Student
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getGrades(): Collection
    {
        return $this->grades;
    }

    /**
     * @param Grade $grade
     *
     * @return Student
     */
    public function addGrade(Grade $grade): Student
    {
        $this->grades[] = $grade;

        return $this;
    }
}
