<?php

namespace AppBundle\ValueObject;

use AppBundle\Entity\Grade;

class SubjectGrades
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $gradeSum;

    /**
     * @var int
     */
    private $weightSum;

    /**
     * @var array
     */
    private $grades = [];

    /**
     * @var float
     */
    private $average;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
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
     * @return int
     */
    public function getWeightSum(): int
    {
        return $this->weightSum;
    }

    /**
     * @param int $weightSum
     */
    public function setWeightSum(int $weightSum)
    {
        $this->weightSum = $weightSum;
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
