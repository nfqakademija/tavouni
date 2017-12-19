<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Assignment;
use AppBundle\Entity\Grade;
use AppBundle\Entity\Student;
use AppBundle\Entity\Subject;
use AppBundle\Repository\StudentRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GradeFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $studentRepository = $this->container->get(StudentRepository::class);
        foreach (SubjectFixtures::$subjects as $subject) {

            /** @var Subject $realSubject */
            $realSubject = $this->getReference($subject['reference']);
            foreach ($realSubject->getAssignments() as $assignment) {
                $students = $studentRepository->getSubjectStudents($assignment->getSubject()->getId());
                foreach ($students as $student) {
                    $manager->persist($this->createGrade($assignment, $student, random_int(1, 10)));
                }
            }
        }
        $manager->flush();
    }

    private function createGrade(Assignment $assignment, Student $student, int $value): Grade
    {
        $grade = new Grade(
            $assignment,
            $student,
            $value
        );

        return $grade;
    }

    public function getDependencies(): array
    {
        return [
            AssignmentFixtures::class,
            StudentFixtures::class,
        ];
    }
}
