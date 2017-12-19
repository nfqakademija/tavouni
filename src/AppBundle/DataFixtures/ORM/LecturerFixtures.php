<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Lecturer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LecturerFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createLecturer('Olga Štikonienė', 'UserOlga', 'LecturerOlga'));
        $manager->persist($this->createLecturer('Antanas Mitašiūnas', 'UserAntanas', 'LecturerAntanas'));
        $manager->persist($this->createLecturer('Linas Litvinas', 'UserLinas', 'LecturerLinas'));
        $manager->flush();
    }

    private function createLecturer(string $name, string $userRef, string $reference): Lecturer
    {
        $lecturer = new Lecturer($name, $this->getReference($userRef));
        $this->addReference($reference, $lecturer);

        return $lecturer;
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}
