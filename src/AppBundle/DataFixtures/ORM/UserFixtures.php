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
        $firstNames = [
            'Ignas',
            'Aurimas',
            'Tadas',
            'Vilius',
            'Vytautas',
            'Tomas',
            'Martynas',
            'Kasparas',
            'Artūras',
            'Deividas'
        ];

        $lastNames = [
            'Zdanis',
            'Rimkus',
            'Adomaitis',
            'Ivoška',
            'Kvietkus',
            'Žukauskas',
            'Stumbrys',
            'Ališauskas',
            'Uždavinys',
            'Rapalavičius'
        ];

        $this->persistPeople($manager, $firstNames, $lastNames, true);
    }
    private function loadLecturers(ObjectManager $manager)
    {
        $firstNames = [
            'Antanas',
            'Linas',
            'Jurgis',
            'Jonas',
            'Andrius',
            'Giedrius',
            'Julius',
            'Rokas',
            'Algirdas',
            'Gediminas'
        ];

        $lastNames = [
            'Zdanis',
            'Rimkus',
            'Adomaitis',
            'Ivoška',
            'Kvietkus',
            'Žukauskas',
            'Stumbrys',
            'Ališauskas',
            'Uždavinys',
            'Rapalavičius'
        ];

        $this->persistPeople($manager, $firstNames, $lastNames, false);
    }

    private function persistPeople(ObjectManager $manager, array $firstNames, array $lastNames, bool $isStudents)
    {
        foreach ($firstNames as $firstName) {
            foreach ($lastNames as $lastName) {
                $manager->persist($this->createUser(
                    $firstName . '.' . $lastName . '@mif.stud.vu.lt',
                    $isStudents ? 'ROLE_STUDENT' : 'ROLE_LECTURER',
                    'U' . ($isStudents ? 'S' : 'L') . $firstName . $lastName,
                    strtolower($firstName . $lastName)
                ));
            }
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
