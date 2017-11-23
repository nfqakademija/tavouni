<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.23
 * Time: 01.08
 */

namespace AppBundle\Entity;

class SubjectGrades
{
    private $id;
    private $name;
    private $gradeSum;
    private $weightSum;
    private $grades = [];

    /**
     * @return mixed
     */
    public function getname()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setname($name)
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getGrades()
    {
        return $this->grades;
    }

    /**
     * @param array $grades
     */
    public function setGrades($grades)
    {
        $this->grades = $grades;
    }

    public function addGrade($grade)
    {
        $this->grades[] = $grade;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getGradeSum()
    {
        return $this->gradeSum;
    }

    /**
     * @param mixed $gradeSum
     */
    public function setGradeSum($gradeSum)
    {
        $this->gradeSum = $gradeSum;
    }

    /**
     * @return mixed
     */
    public function getWeightSum()
    {
        return $this->weightSum;
    }

    /**
     * @param mixed $weightSum
     */
    public function setWeightSum($weightSum)
    {
        $this->weightSum = $weightSum;
    }
}
