<?php

namespace AppBundle\ValueObject;

use AppBundle\Entity\Grade;

class SubjectGrades
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $gradeSum;

    /**
     * @var array
     */
    private $grades = [];

    /**
     * @var float
     */
    private $average;
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getGradeSum(): int
    {
        return $this->gradeSum;
    }

    /**
     * @param int $gradeSum
     */
    public function setGradeSum(int $gradeSum)
    {
        $this->gradeSum = $gradeSum;
    }

    /**
     * @return array
     */
    public function getGrades(): array
    {
        return $this->grades;
    }

    /**
     * @param array $grades
     */
    public function setGrades(array $grades)
    {
        $this->grades = $grades;
    }

    /**
     * @param Grade $grade
     */
    public function addGrade(Grade $grade)
    {
        $this->grades[] = $grade;
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
     */
    public function setAverage(float $average)
    {
        $this->average = $average;
    }
}
