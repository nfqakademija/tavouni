<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.7
 * Time: 13.54
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Subject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SubjectFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createSubject('Kompiuterių architektūra', 'Privalomas', 'KompArch', 'LecturerAntanas'));
        $manager->persist($this->createSubject('Skaitiniai metodai', 'Pasirenkamasis', 'SkaitiniaiMetodai', 'LecturerOlga'));
        $manager->flush();
    }

    private function createSubject($name, $type, $referenceName, $coordinator)
    {
        $subject = new Subject();
        $subject->setName($name);
        $subject->setSubjectType($type);
        $subject->setCoordinator($this->getReference($coordinator));
        $this->addReference($referenceName, $subject);
        return $subject;
    }
    public function getDependencies()
    {
        return [
            LecturerFixtures::class,
        ];
    }
}
