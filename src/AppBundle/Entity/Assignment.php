<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Assignment
 *
 * @ORM\Table(name="assignments")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AssignmentRepository")
 */
class Assignment
{
    private $average;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Subject
     *
     * @ORM\ManyToOne(targetEntity="Subject", inversedBy="assignments")
     */
    private $subject;

    /**
     * @var int
     *
     * @ORM\Column(name="weight", type="integer")
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var LectureType
     *
     * @ORM\ManyToOne(targetEntity="LectureType")
     */
    private $lectureType;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Grade", mappedBy="assignment")
     */
    private $grades;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deadline", type="date", nullable=true)
     */
    private $deadline;


    /**
     * Assignment constructor.
     * @param Subject $subject
     * @param int $weight
     * @param string $name
     * @param LectureType $lectureType
     */
    public function __construct(Subject $subject, $weight, $name, LectureType $lectureType, $deadline = null)
    {
        $this->subject = $subject;
        $this->weight = $weight;
        $this->name = $name;
        $this->lectureType = $lectureType;
        $this->deadline = $deadline;
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
     * Set subject
     *
     * @param string $subject
     *
     * @return Assignment
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return Assignment
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Assignment
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
     * Set lectureType
     *
     * @param LectureType $lectureType
     *
     * @return Assignment
     */
    public function setLectureType($lectureType)
    {
        $this->lectureType = $lectureType;

        return $this;
    }

    /**
     * Get lectureType
     *
     * @return LectureType
     */
    public function getLectureType()
    {
        return $this->lectureType;
    }

    /**
     * @return ArrayCollection
     */
    public function getGrades(): ArrayCollection
    {
        return $this->grades;
    }

    /**
     * @param Grade $grade
     */
    public function addGrade(Grade $grade)
    {
        $this->grades[] = $grade;
    }

    /**
     * @return mixed
     */
    public function getAverage()
    {
        return $this->average;
    }

    /**
     * @param mixed $average
     */
    public function setAverage($average)
    {
        $this->average = $average;
    }

    /**
     * @return \DateTime
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * @param \DateTime $deadline
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    }
}
