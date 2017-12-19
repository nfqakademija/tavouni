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
        foreach (UserFixtures::$lecturers as $lecturer) {
            $manager->persist($this->createLecturer(
                $lecturer['firstName'] . ' ' . $lecturer['lastName'],
                'UL' . $lecturer['firstName'] . $lecturer['lastName'],
                'L' . $lecturer['firstName'] . $lecturer['lastName']
            ));
        }

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
