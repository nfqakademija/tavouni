<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Grade
 *
 * @ORM\Table(name="grades",
 *     uniqueConstraints={
 *        @UniqueConstraint(name="grade_unique",
 *            columns={"assignment_id", "student_id"})
 *    }
 * )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GradeRepository")
 */
class Grade
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
     * @var Assignment
     *
     * @ORM\ManyToOne(targetEntity="Assignment", inversedBy="grades")
     */
    private $assignment;

    /**
     * @var Student
     *
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="grades")
     */
    private $student;

    /**
     * @var int
     *
     * @ORM\Column(name="grade", type="integer")
     */
    private $value;

    /**
     * Grade constructor.
     * @param Assignment $assignment
     * @param Student $student
     * @param int $value
     */
    public function __construct(Assignment $assignment, Student $student, $value)
    {
        $this->assignment = $assignment;
        $this->student = $student;
        $this->value = $value;
    }

    /**
     * Set assignment
     *
     * @param Assignment $assignment
     *
     * @return Grade
     */
    public function setAssignment($assignment)
    {
        $this->assignment = $assignment;

        return $this;
    }

    /**
     * Get assignment
     *
     * @return Assignment
     */
    public function getAssignment()
    {
        return $this->assignment;
    }

    /**
     * Set student
     *
     * @param Student $student
     *
     * @return Grade
     */
    public function setStudent($student)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return Student
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set value
     *
     * @param integer $value
     *
     * @return Grade
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
