<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class StudentFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->persistStudents(UserFixtures::$students, $manager);
        $manager->flush();
    }

    private function persistStudents(array $studentsWithGroups, ObjectManager $manager)
    {
        foreach ($studentsWithGroups as $student) {
            $manager->persist($this->createStudent(
                'US' . $student['firstName'] . $student['lastName'],
                $student['firstName'] . ' ' . $student['lastName'],
                $student['groupsRefs'],
                'S' . $student['firstName'] . $student['lastName']
            ));
        }
    }

    private function createStudent(string $userRef, string $name, array $groupsRefs, string $reference): Student
    {
        $student = new Student($this->getReference($userRef), $name);
        foreach ($groupsRefs as $groupRef) {
            $student->addGroup($this->getReference($groupRef));
        }
        $this->addReference($reference, $student);
        return $student;
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            GroupFixtures::class
        ];
    }
}
