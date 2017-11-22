<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StudentAssignment
 *
 * @ORM\Table(name="students_assignments")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StudentAssignmentRepository")
 */
class StudentAssignment
{
    /**
     * @var Assignment
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Assignment", inversedBy="studentAssignments")
     */
    private $assignment;

    /**
     * @var Student
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="studentAssignments")
     */
    private $student;

    /**
     * @var int
     *
     * @ORM\Column(name="grade", type="integer")
     */
    private $grade;

    /**
     * Set assignment
     *
     * @param Assignment $assignment
     *
     * @return StudentAssignment
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
     * @return StudentAssignment
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
     * Set grade
     *
     * @param integer $grade
     *
     * @return StudentAssignment
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get grade
     *
     * @return int
     */
    public function getGrade()
    {
        return $this->grade;
    }
}

