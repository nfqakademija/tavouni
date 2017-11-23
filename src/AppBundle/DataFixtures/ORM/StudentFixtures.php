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
        $manager->persist($this->createStudent('Ignas Zdanis', 'UserIgnas', ['PS1k', 'SM'], 'StudentIgnas'));
        $manager->persist($this->createStudent('Aurimas Rimkus', 'UserAurimas', ['PS1k'], 'StudentAurimas'));
        $manager->flush();
    }
    private function createStudent($name, $user, $groups, $reference)
    {
        $student = new Student();
        $student->setName($name);
        $student->setUser($this->getReference($user));
        foreach ($groups as $group) {
            $student->addGroup($this->getReference($group));
        }
        //$student->addGroup($this->getReference($groups));
        $this->addReference($reference, $student);
        return $student;
    }
    public function getDependencies()
    {
        return [
            UserFixtures::class,
            GroupFixtures::class
        ];
    }
}
