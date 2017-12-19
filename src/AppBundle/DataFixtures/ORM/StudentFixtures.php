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
        $students = [
            [
                'firstName' => 'Ignas',
                'lastName' => 'Zdanis',
                'groupsRefs' => ['PS3k', 'PS3k3g', 'SM', 'SM1g', 'PST2g', 'FUN']
            ],
            [
                'firstName' => 'Ignas',
                'lastName' => 'Kvietkus',
                'groupsRefs' => ['PS3k', 'PS3k3g', 'SM', 'SM1g', 'PST2g', 'LOG']
            ],
            [
                'firstName' => 'Ignas',
                'lastName' => 'Ivoška',
                'groupsRefs' => ['PS3k', 'PS3k3g', 'SM', 'SM1g', 'PST2g', 'LOG']
            ],
            [
                'firstName' => 'Aurimas',
                'lastName' => 'Rimkus',
                'groupsRefs' => ['PS3k', 'PS3k3g', 'APP', 'APP2g', 'PST2g', 'KOM']
            ],
            [
                'firstName' => 'Tadas',
                'lastName' => 'Adomaitis',
                'groupsRefs' => ['PS3k', 'PS3k3g', 'SM', 'SM1g', 'PST2g', 'LOG']
            ],
            [
                'firstName' => 'Vilius',
                'lastName' => 'Žukauskas',
                'groupsRefs' => ['PS3k', 'PS3k6g', 'SM', 'SM1g', 'PST1g', 'LOG'],
            ],
            [
                'firstName' => 'Tomas',
                'lastName' => 'Ūselis',
                'groupsRefs' => ['PS3k', 'PS3k3g', 'APP', 'APP2g', 'PST2g']
            ],
            [
                'firstName' => 'Dovydas',
                'lastName' => 'Skrebė',
                'groupsRefs' => ['PS3k', 'PS3k3g', 'APP', 'APP2g', 'PST2g']
            ],
            [
                'firstName' => 'Saulius',
                'lastName' => 'Skliutas',
                'groupsRefs' => ['PS3k', 'PS3k3g', 'KOD', 'APP', 'PST2g']
            ],
            [
                'firstName' => 'Andrius',
                'lastName' => 'Paulauskas',
                'groupsRefs' => ['PS3k', 'PS3k3g', 'KOD', 'PST2g']
            ],
            [
                'firstName' => 'Lukas',
                'lastName' => 'Andriejūnas',
                'groupsRefs' => ['PS3k', 'PS3k3g', 'APP', 'APP2g', 'KOD', 'PST2g']
            ],
            [
                'firstName' => 'Tomas',
                'lastName' => 'Germanavičius',
                'groupsRefs' => ['PS3k', 'PS3k3g', 'KOD', 'PST2g']
            ],
            [
                'firstName' => 'Gerda',
                'lastName' => 'Šimoliūnaitė',
                'groupsRefs' => ['PS3k', 'PS3k3g', 'FUN', 'KOM', 'PST2g']
            ],
            [
                'firstName' =>'Greta',
                'lastName' => 'Mameniškytė',
                'groupsRefs' => ['PS3k', 'PS3k3g', 'APP', 'APP1g', 'KOD', 'PST2g']
            ],
            [
                'firstName' => 'Rytis',
                'lastName' => 'Kaplūnas',
                'groupsRefs' => ['PS3k', 'PS3k6g', 'APP', 'APP1g', 'KOM', 'PST1g']
            ],
            [
                'firstName' => 'Domantas',
                'lastName' => 'Pelaitis',
                'groupsRefs' => ['PS3k', 'PS3k3g', 'APP', 'APP2g', 'KOD', 'PST2g']
            ],
            [
                'firstName' => 'Domantas',
                'lastName' => 'Jadenkus',
                'groupsRefs' => ['PS3k', 'PS3k3g', 'APP', 'APP1g', 'FUN', 'PST2g']
            ],
            [
                'firstName' => 'Domantas',
                'lastName' => 'Lekavičius',
                'groupsRefs' => ['PS3k', 'PS3k6g', 'FUN', 'SM', 'SM1g', 'PST1g']
            ],
            [
                'firstName' => 'Lukas',
                'lastName' => 'Valatka',
                'groupsRefs' => ['PS3k', 'PS3k6g', 'LOG', 'KOD', 'PST1g']
            ],
            [
                'firstName' => 'Solveiga',
                'lastName' => 'Benediktavičiūtė',
                'groupsRefs' => ['PS3k', 'PS3k6g', 'FUN', 'SM', 'SM1g', 'PST1g']
            ],
            [
                'firstName' => 'Greta',
                'lastName' => 'Griškaitytė',
                'groupsRefs' => ['PS3k', 'PS3k6g', 'FUN', 'KOD', 'PST1g']
            ],
            [
                'firstName' => 'Viktorija',
                'lastName' => 'Kazokaitytė',
                'groupsRefs' => ['PS3k', 'PS3k3g', 'LOG', 'SM', 'SM1g', 'PST2g']
            ],
            [
                'firstName' => 'Reda',
                'lastName' => 'Kviekutė',
                'groupsRefs' => ['PS3k', 'PS3k6g', 'FUN', 'KOM', 'PST1g']
            ],
            [
                'firstName' => 'Jovaras',
                'lastName' => 'Ivoška',
                'groupsRefs' => ['PS3k', 'PS3k6g', 'LOG', 'SM', 'SM1g', 'PST1g']
            ],
            [
                'firstName' => 'Jurgita',
                'lastName' => 'Paulauskaitė',
                'groupsRefs' => ['PS3k', 'PS3k3g', 'LOG', 'SM', 'SM1g', 'PST2g']
            ],
        ];
        $this->persistStudents($students, $manager);
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
