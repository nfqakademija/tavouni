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
        $lectureDate = new LectureDate();
        $lectureDate->setLecture($this->getReference('KompArchTeor'));
        $start = new \DateTime();
        $end = new \DateTime();
        $start->setDate(2017, 11, 8);
        $end->setDate(2017, 11, 8);
        $start->setTime(14, 0);
        $end->setTime(16, 0);
        $lectureDate->setEnd($end);
        $lectureDate->setStart($start);
        $manager->persist($lectureDate);
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            LectureFixtures::class,
        ];
    }
}
