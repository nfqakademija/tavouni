<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.23
 * Time: 12.04
 */

namespace AppBundle\Utils;


use AppBundle\Entity\SubjectGrades;
use AppBundle\Repository\GradeRepository;

class SubjectGradeParser
{
    private $gradeRepository;
    public function __construct(GradeRepository $gradeRepository)
    {
        $this->gradeRepository=$gradeRepository;
    }

    public function gradesToSubjectGrades($id) {
        $grades = $this->gradeRepository->getStudentGrades($id);
        $subjects = [];
        foreach ($grades as $grade) {
            $found = false;
            foreach ($subjects as $subject) {
                if ($grade->getAssignment()->getSubject()->getName() === $subject->getName()) {
                    $subject->addGrade($grade);
                    $found = true;
                }
            }
            if (!$found) {
                $subject = new SubjectGrades();
                $subject->setName($grade->getAssignment()->getSubject()->getName());
                $subject->setId($grade->getAssignment()->getSubject()->getId());
                $subject->addGrade($grade);
                $subjects[] = $subject;
            }
        }
        foreach ($subjects as $subject) {
            $gradeSum = 0;
            $weightSum = 0;
            foreach ($subject->getGrades() as $grade) {
                $gradeSum += $grade->getValue()*$grade->getAssignment()->getWeight()/100;
                $weightSum += $grade->getAssignment()->getWeight();
            }
            $subject->setGradeSum($gradeSum);
            $subject->setWeightSum($weightSum);
        }
        return $subjects;
    }
}