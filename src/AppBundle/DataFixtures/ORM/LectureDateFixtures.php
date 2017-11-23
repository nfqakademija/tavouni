<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.7
 * Time: 14.06
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\LectureDate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LectureDateFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createLectureDate('KompArchTeor', new \DateTime('2017-11-23T14:00')));
        $manager->persist($this->createLectureDate('KompArchTeor', new \DateTime('2017-11-30T14:00')));
        $manager->persist($this->createLectureDate('KompArchTeor', new \DateTime('2017-11-16T14:00')));
        $manager->persist($this->createLectureDate('SMTeor', new \DateTime('2017-11-30T10:00')));
        $manager->persist($this->createLectureDate('SMTeor', new \DateTime('2017-11-16T10:00')));
        $manager->persist($this->createLectureDate('SMTeor', new \DateTime('2017-11-23T10:00')));
        $manager->flush();
    }
    private function createLectureDate($lecture, $date)
    {
        $lectureDate = new LectureDate();
        $lectureDate->setLecture($this->getReference($lecture));
        $lectureDate->setStart($date);
        $end = clone $date;
        $end = $end->add(new \DateInterval('PT2H'));
        $lectureDate->setEnd($end);
        return $lectureDate;
    }
    public function getDependencies()
    {
        return [
            LectureFixtures::class,
        ];
    }
}
