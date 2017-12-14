<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class StudentFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createStudent('Ignas Zdanis', 'UserIgnas', ['PS1k', 'SM', 'PS1k2g'], 'StudentIgnas'));
        $manager->persist($this->createStudent('Aurimas Rimkus', 'UserAurimas', ['PS1k', 'PS1k1g'], 'StudentAurimas'));
        $manager->flush();
    }

    private function createStudent(string $name, string $userRef, array $groupsRefs, string $reference): Student
    {
        $student = new Student();
        $student->setName($name);
        $student->setUser($this->getReference($userRef));
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
