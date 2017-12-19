<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Lecture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LectureFixtures extends Fixture
{
    /**
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
        string $lectureType
    ): Lecture {
        $lecture = new Lecture(
            $this->getReference($subjectRef),
            $this->getReference($lecturerRef),
            $this->getReference($groupRef),
            $this->getReference('101didl'),
            $lectureType
        );
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
