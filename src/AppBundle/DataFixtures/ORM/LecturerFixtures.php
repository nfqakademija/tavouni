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
        $manager->persist($this->createLecturer('Olga Štikonienė', 'UserOlga', 'LecturerOlga'));
        $manager->persist($this->createLecturer('Antanas Mitašiūnas', 'UserAntanas', 'LecturerAntanas'));
        $manager->persist($this->createLecturer('Linas Litvinas', 'UserLinas', 'LecturerLinas'));
        $manager->flush();
    }
    private function createLecturer($name, $user, $reference)
    {
        $lecturer = new Lecturer();
        $lecturer->setName($name);
        $lecturer->setUser($this->getReference($user));
        $this->addReference($reference, $lecturer);
        return $lecturer;
    }
    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }
}
