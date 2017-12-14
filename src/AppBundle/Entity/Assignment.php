<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Assignment
 *
 * @ORM\Table(name="assignments")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AssignmentRepository")
 */
class Assignment
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
     * @var AssignmentEvent
     *
     * @ORM\OneToOne(targetEntity="AssignmentEvent", inversedBy="assignment", cascade={"persist"})
     * @ORM\JoinColumn(name="assignment_event_id", referencedColumnName="id")
     */
    private $assignmentEvent;

    /**
     * @var float
     */
    private $average;

    /**
     * Assignment constructor.
     * @param Subject $subject
     * @param int $weight
     * @param string $name
     * @param LectureType $lectureType
     */
    public function __construct(
        Subject $subject,
        $weight,
        $name,
        LectureType $lectureType,
        $deadline = null,
        $assignmentEvent = null
    ) {
        $this->subject = $subject;
        $this->weight = $weight;
        $this->name = $name;
        $this->lectureType = $lectureType;
        $this->deadline = $deadline;
        $this->assignmentEvent = $assignmentEvent;
        $this->grades = new ArrayCollection();
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
     * @param Subject $subject
     *
     * @return Assignment
     */
    public function setSubject(Subject $subject): Assignment
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return Subject
     */
    public function getSubject(): Subject
    {
        return $this->subject;
    }

    /**
     * Set weight
     *
     * @param int $weight
     *
     * @return Assignment
     */
    public function setWeight(int $weight): Assignment
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return int
     */
    public function getWeight(): int
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
    public function setName(string $name): Assignment
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
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
    public function setLectureType(LectureType $lectureType): Assignment
    {
        $this->lectureType = $lectureType;

        return $this;
    }

    /**
     * Get lectureType
     *
     * @return LectureType
     */
    public function getLectureType(): LectureType
    {
        return $this->lectureType;
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
     * @return Assignment
     */
    public function addGrade(Grade $grade): Assignment
    {
        $this->grades->add($grade);

        return $this;
    }

    /**
     * @return float
     */
    public function getAverage(): float
    {
        return $this->average;
    }

    /**
     * @param float $average
     *
     * @return Assignment
     */
    public function setAverage(float $average): Assignment
    {
        $this->average = $average;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDeadline(): \DateTime
    {
        return $this->deadline;
    }

    /**
     * @param \DateTime $deadline
     *
     * @return Assignment
     */
    public function setDeadline(\DateTime $deadline): Assignment
    {
        $this->deadline = $deadline;

        return $this;
    }

    /**
     * @return AssignmentEvent
     */
    public function getAssignmentEvent(): AssignmentEvent
    {
        return $this->assignmentEvent;
    }

    /**
     * @param AssignmentEvent $assignmentEvent
     *
     * @return Assignment
     */
    public function setAssignmentEvent(AssignmentEvent $assignmentEvent): Assignment
    {
        $this->assignmentEvent = $assignmentEvent;

        return $this;
    }
}
