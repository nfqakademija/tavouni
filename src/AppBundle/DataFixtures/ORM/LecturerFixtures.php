<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.7
 * Time: 13.55
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Lecturer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LecturerFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $lecturer = new Lecturer();
        $lecturer->setName('Antanas Mitašiūnas');
        $manager->persist($lecturer);
        $manager->flush();
        $this->addReference('Mitasiunas', $lecturer);
    }
}