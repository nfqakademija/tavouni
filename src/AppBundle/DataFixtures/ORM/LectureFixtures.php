<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.7
 * Time: 13.57
 */

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
        $manager->persist($this->createLecture('PS1k', 'KompArch', 'LecturerAntanas', 'KompArchTeor'));
        $manager->persist($this->createLecture('SM', 'SkaitiniaiMetodai', 'LecturerOlga', 'SMTeor'));
        $manager->flush();
    }
    private function createLecture($group, $subject, $lecturer, $reference)
    {
        $lecture = new Lecture();
        $lecture->setRoom($this->getReference('101didl'));
        $lecture->setGroup($this->getReference($group));
        $lecture->setSubject($this->getReference($subject));
        $lecture->setLecturer($this->getReference($lecturer));
        $lecture->setLectureType($this->getReference('Teorija'));
        $this->addReference($reference, $lecture);
        return $lecture;
    }
    public function getDependencies()
    {
        return [
            RoomFixtures::class,
            GroupFixtures::class,
            SubjectFixtures::class,
            LecturerFixtures::class,
            LectureTypeFixtures::class,
        ];
    }
}
