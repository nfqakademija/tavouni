<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.22
 * Time: 23.59
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Grade;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GradeFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createGrade('KompArchEgz', 'StudentIgnas', 9));
        $manager->persist($this->createGrade('KompArchKont', 'StudentIgnas', 9));
        $manager->persist($this->createGrade('SMEgz', 'StudentIgnas', 9));
        $manager->persist($this->createGrade('SM1l', 'StudentIgnas', 7));
        $manager->persist($this->createGrade('SM2l', 'StudentIgnas', 4));
        $manager->persist($this->createGrade('KompArchEgz', 'StudentAurimas', 7));
        $manager->persist($this->createGrade('KompArchKont', 'StudentAurimas', 4));
        $manager->flush();
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
