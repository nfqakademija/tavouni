<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\LectureType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LectureTypeFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createLectureType('Teorija', 'Teorija'));
        $manager->persist($this->createLectureType('Pratybos', 'Pratybos'));
        $manager->flush();
    }

    private function createLectureType(string $name, string $reference): LectureType
    {
        $lectureType = new LectureType();
        $lectureType->setName($name);
        $this->addReference($reference, $lectureType);

        return $lectureType;
    }
}
