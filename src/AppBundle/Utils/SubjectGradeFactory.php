<?php

namespace AppBundle\Utils;

use AppBundle\Entity\Assignment;
use AppBundle\Repository\AssignmentRepository;
use AppBundle\Repository\GradeRepository;
use AppBundle\ValueObject\SubjectGrades;

class SubjectGradeFactory
{
    /**
     * @var GradeRepository
     */
    private $gradeRepository;

    /**
     * @var AssignmentRepository
     */
    private $assignmentRepository;

    public function __construct(GradeRepository $gradeRepository, AssignmentRepository $assignmentRepository)
    {
        $this->gradeRepository = $gradeRepository;
        $this->assignmentRepository = $assignmentRepository;
    }

    public function createSubjectGradeCollection(int $id): array
    {
        $grades = $this->gradeRepository->getStudentGrades($id);
        $assignmentsAverages = $this->assignmentRepository->getAssignmentsGradesAverageByStudentGroup($id);
        $subjects = $this->sortGradesBySubject($grades);
        $this->setSubjectAverageAndGradeSum($subjects, $assignmentsAverages);

        return $subjects;
    }

    private function setSubjectAverageAndGradeSum(array $subjects, array $assignmentsAverages): array
    {
        foreach ($subjects as $subject) {
            $gradeSum = 0;
            $averageSum = 0;
            foreach ($subject->getGrades() as $grade) {
                $gradeSum += $grade->getValue() * $grade->getAssignment()->getWeight() / 100;
                $average = $this->getAssignmentAverage($assignmentsAverages, $grade->getAssignment());
                $grade->getAssignment()->setAverage($average);
                $averageSum += $grade->getAssignment()->getAverage() * $grade->getAssignment()->getWeight() / 100;
            }
            $subject->setGradeSum($gradeSum);
            $subject->setAverage($averageSum);
        }

        return $subjects;
    }

    private function sortGradesBySubject(array $grades): array
    {
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
                $subject->addGrade($grade);
                $subjects[] = $subject;
            }
        }

        return $subjects;
    }

    private function getAssignmentAverage(array $averages, Assignment $assignment): float
    {
        foreach ($averages as $average) {
            if ($average[0] === $assignment) {
                return round($average[1], 2);
            }
        }

        throw new \Exception('Assignment not found');
    }
}
