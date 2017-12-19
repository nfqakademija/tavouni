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
        $manager->persist($this->createStudent(
            'USIgnasZdanis',
            'Ignas Zdanis',
            ['PS1k', 'SM', 'PS1k2g'],
            'StudentIgnas'
        ));
        $manager->persist($this->createStudent(
            'USAurimasRimkus',
            'Aurimas Rimkus',
            ['PS1k', 'PS1k1g'],
            'StudentAurimas'
        ));
        $manager->flush();
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
