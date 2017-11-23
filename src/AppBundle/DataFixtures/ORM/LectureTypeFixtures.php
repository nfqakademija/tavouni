<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.22
 * Time: 23.16
 */

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
        $lectureType = new LectureType();
        $lectureType->setName("Teorija");
        $manager->persist($lectureType);
        $manager->flush();
        $this->addReference('Teorija', $lectureType);
    }
}