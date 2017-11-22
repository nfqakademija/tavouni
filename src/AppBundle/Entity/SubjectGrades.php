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
    private $subject;
    private $grades = [];

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
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

    public function addGrade($grade) {
        $this->grades[] = $grade;
    }
}