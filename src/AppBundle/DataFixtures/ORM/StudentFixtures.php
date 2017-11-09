<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.7
 * Time: 14.05
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class StudentFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $student = new Student();
        $student->setName('Ignas');
        $student->setUser($this->getReference('UserIgnas'));
        $student->addGroup($this->getReference('PS1k'));
        $manager->persist($student);
        $manager->flush();
        $this->addReference('StudentIgnas', $student);
    }
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            GroupFixtures::class
        );
    }
}
