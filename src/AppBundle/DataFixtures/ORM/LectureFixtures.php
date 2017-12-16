<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Lecture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LectureFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createLecture('PS1k', 'KompArch', 'LecturerAntanas', 'KompArchTeor', 'Teorija'));
        $manager->persist($this->createLecture('PS1k1g', 'KompArch', 'LecturerLinas', 'KompArch1g', 'Pratybos'));
        $manager->persist($this->createLecture('PS1k2g', 'KompArch', 'LecturerAntanas', 'KompArch2g', 'Pratybos'));
        $manager->persist($this->createLecture('SM', 'SkaitiniaiMetodai', 'LecturerOlga', 'SMTeor', 'Teorija'));
        $manager->flush();
    }

    private function createLecture(
        string $groupRef,
        string $subjectRef,
        string $lecturerRef,
        string $reference,
        string $lectureTypeRef
    ): Lecture {
        $lecture = new Lecture();
        $lecture->setRoom($this->getReference('101didl'));
        $lecture->setGroup($this->getReference($groupRef));
        $lecture->setSubject($this->getReference($subjectRef));
        $lecture->setLecturer($this->getReference($lecturerRef));
        $lecture->setLectureType($lectureTypeRef);
        $this->addReference($reference, $lecture);

        return $lecture;
    }

    public function getDependencies(): array
    {
        return [
            RoomFixtures::class,
            GroupFixtures::class,
            SubjectFixtures::class,
            LecturerFixtures::class,
        ];
    }
}
