<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public static $students;
    public static $lecturers;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->loadStudents($manager);
        $this->loadLecturers($manager);
        $manager->flush();
    }

    private function loadStudents(ObjectManager $manager)
    {
        $this::$students = [
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
        $this->persistPeople($manager, $this::$students, true);
    }

    private function loadLecturers(ObjectManager $manager)
    {
        $this::$lecturers = [
            ['firstName' => 'Vytautas', 'lastName' => 'Valaitis'],
            ['firstName' => 'Vaidas', 'lastName' => 'Jusevičius'],
            ['firstName' => 'Viačiaslav', 'lastName' => 'Pozdniakov'],
            ['firstName' => 'Mindaugas', 'lastName' => 'Plukas'],
            ['firstName' => 'Kristina', 'lastName' => 'Lapin'],
            ['firstName' => 'Tomas', 'lastName' => 'Tumasonis'],
            ['firstName' => 'Justinas', 'lastName' => 'Marcinka'],
            ['firstName' => 'Gintaras', 'lastName' => 'Skersys'],
            ['firstName' => 'Olga', 'lastName' => 'Štikonienė'],
            ['firstName' => 'Gailė', 'lastName' => 'Paukštaitė'],
            ['firstName' => 'Mindaugas', 'lastName' => 'Eglinskas'],
            ['firstName' => 'Mindaugas', 'lastName' => 'Karpinskas'],
            ['firstName' => 'Giedrius', 'lastName' => 'Graževičius'],
        ];
        $this->persistPeople($manager, $this::$lecturers, false);
    }

    private function persistPeople(ObjectManager $manager, array $people, bool $isStudents)
    {
        foreach ($people as $person) {
            $manager->persist($this->createUser(
                /* normalizing string */
                strtolower(iconv(
                    'UTF-8',
                    'ISO-8859-1//TRANSLIT//IGNORE',
                    $person['firstName'] . '.' . $person['lastName'] . '@mif.stud.vu.lt'
                )),
                $isStudents ? 'ROLE_STUDENT' : 'ROLE_LECTURER',
                'U' . ($isStudents ? 'S' : 'L') . $person['firstName'] . $person['lastName'],
                strtolower($person['firstName'] . $person['lastName'])
            ));
        }
    }

    private function createUser(string $username, string $role, string $reference, string $apiKey): User
    {
        $user = new User(
            $username,
            'test',
            [$role],
            true,
            $username,
            $apiKey
        );
        $this->addReference($reference, $user);

        return $user;
    }
}
