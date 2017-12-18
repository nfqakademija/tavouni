<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;
    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Lecture", mappedBy="group")
     */
    private $lectures;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Student", mappedBy="groups")
     */
    private $students;

    public function __construct(string $name, int $number)
    {
        $this->lectures = new ArrayCollection();
        $this->students = new ArrayCollection();
        $this->name = $name;
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Group
     */
    public function setName(string $name): Group
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getLectures(): ArrayCollection
    {
        return $this->lectures;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     *
     * @return Group
     */
    public function setNumber(int $number): Group
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getStudents(): ArrayCollection
    {
        return $this->students;
    }

    /**
     * @param Student $student
     *
     * @return Group
     */
    public function addStudent(Student $student): Group
    {
        $this->students->add($student);

        return $this;
    }
}
