<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->loadStudents($manager);
        $this->loadLecturers($manager);
        $manager->persist($this->createUser('Ignas', 'ROLE_STUDENT', 'UserIgnas', 'ignas'));
        $manager->persist($this->createUser('Aurimas', 'ROLE_STUDENT', 'UserAurimas', 'aurimas'));
        $manager->persist($this->createUser('Antanas', 'ROLE_LECTURER', 'UserAntanas', 'antanas'));
        $manager->persist($this->createUser('Olga', 'ROLE_LECTURER', 'UserOlga', 'olga'));
        $manager->persist($this->createUser('Linas', 'ROLE_LECTURER', 'UserLinas', 'linas'));
        $manager->flush();
    }
    private function loadStudents(ObjectManager $manager)
    {
        $students = [
            ['firstName' => 'Ignas', 'lastName' => 'Zdanis'],
            ['firstName' => 'Ignas', 'lastName' => 'Kvietkus'],
            ['firstName' => 'Ignas', 'lastName' => 'Ivoška'],
            ['firstName' => 'Aurimas', 'lastName' => 'Rimkus'],
            ['firstName' => 'Tadas', 'lastName' => 'Adomaitis'],
            ['firstName' => 'Vilius', 'lastName' => 'Žukauskas'],
            ['firstName' => 'Tomas', 'lastName' => 'Ūselis'],
            ['firstName' => 'Dovydas', 'lastName' => 'Skrebė'],
            ['firstName' => 'Saulius', 'lastName' => 'Skliutas'],
            ['firstName' => 'Andrius', 'lastName' => 'Paulauskas'],
            ['firstName' => 'Lukas', 'lastName' => 'Andriejūnas'],
            ['firstName' => 'Tomas', 'lastName' => 'Germanavičius'],
            ['firstName' => 'Gerda', 'lastName' => 'Šimoliūnaitė'],
            ['firstName' => 'Greta', 'lastName' => 'Mameniškytė'],
            ['firstName' => 'Rytis', 'lastName' => 'Kaplūnas'],
            ['firstName' => 'Domantas', 'lastName' => 'Pelaitis'],
            ['firstName' => 'Domantas', 'lastName' => 'Jadenkus'],
            ['firstName' => 'Domantas', 'lastName' => 'Lekavičius'],
            ['firstName' => 'Lukas', 'lastName' => 'Valatka'],
            ['firstName' => 'Solveiga', 'lastName' => 'Benediktavičiūtė'],
            ['firstName' => 'Greta', 'lastName' => 'Griškaitytė'],
            ['firstName' => 'Viktorija', 'lastName' => 'Kazokaitytė'],
            ['firstName' => 'Reda', 'lastName' => 'Kviekutė'],
            ['firstName' => 'Jovaras', 'lastName' => 'Ivoška'],
            ['firstName' => 'Jurgita', 'lastName' => 'Paulauskaitė'],
        ];

        $this->persistPeople($manager, $students, true);
    }
    private function loadLecturers(ObjectManager $manager)
    {
        $lecturers = [
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

        $this->persistPeople($manager, $lecturers, false);
    }

    private function persistPeople(ObjectManager $manager, array $people, bool $isStudents)
    {
        foreach ($people as $person) {
            $manager->persist($this->createUser(
                $person['firstName'] . '.' . $person['lastName'] . '@mif.stud.vu.lt',
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
