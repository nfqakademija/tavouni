<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Grade;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GradeFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
    }

    private function createGrade(string $assignmentRef, string $studentRef, int $value): Grade
    {
        $grade = new Grade(
            $this->getReference($assignmentRef),
            $this->getReference($studentRef),
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
