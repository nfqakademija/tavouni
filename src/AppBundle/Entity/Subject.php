<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Subject
 *
 * @ORM\Table(name="subjects")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubjectRepository")
 */
class Subject
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
     * @ORM\Column(name="subjectType", type="string", length=255)
     */
    private $subjectType;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Lecture", mappedBy="subject")
     */
    private $lectures;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Assignment", mappedBy="subject")
     */
    private $assignments;

    /**
     * @var Lecturer
     *
     * @ORM\ManyToOne(targetEntity="Lecturer", inversedBy="subjects")
     * @ORM\JoinColumn(name="lecturer_id", referencedColumnName="id", nullable=false)
     */
    private $coordinator;

    /**
     * @return ArrayCollection
     */
    public function getLectures()
    {
        return $this->lectures;
    }

    /**
     * @param ArrayCollection $lectures
     */
    public function setLectures($lectures)
    {
        $this->lectures = $lectures;
    }

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
     * Set subjectType
     *
     * @param string $subjectType
     *
     * @return Subject
     */
    public function setSubjectType($subjectType)
    {
        $this->subjectType = $subjectType;

        return $this;
    }

    /**
     * Get subjectType
     *
     * @return string
     */
    public function getSubjectType()
    {
        return $this->subjectType;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Subject
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Lecturer
     */
    public function getCoordinator(): Lecturer
    {
        return $this->coordinator;
    }

    /**
     * @param Lecturer $coordinator
     */
    public function setCoordinator(Lecturer $coordinator)
    {
        $this->coordinator = $coordinator;
    }

    /**
     * @return ArrayCollection
     */
    public function getAssignments(): ArrayCollection
    {
        return $this->assignments;
    }

    /**
     * @param Assignment $assignment
     */
    public function addAssignment(Assignment $assignment)
    {
        $this->assignments[] = $assignment;
    }
}
