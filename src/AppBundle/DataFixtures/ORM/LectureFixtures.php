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
        $lecture = new Lecture();
        $lecture->setRoom($this->getReference('101didl'));
        $lecture->setGroup($this->getReference('PS1k'));
        $lecture->setSubject($this->getReference('KompArch'));
        $lecture->setLecturer($this->getReference('Mitasiunas'));
        $lecture->setLectureType('Teorija');
        $manager->persist($lecture);
        $manager->flush();
        $this->addReference('KompArchTeor', $lecture);
    }
    public function getDependencies()
    {
        return array(
            RoomFixtures::class,
            GroupFixtures::class,
            SubjectFixtures::class,
            LecturerFixtures::class,
        );
    }
}