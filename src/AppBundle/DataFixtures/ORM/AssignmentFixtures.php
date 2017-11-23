<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.22
 * Time: 23.58
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Assignment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AssignmentFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createAssignment('Egzaminas', 'KompArch', 60, 'KompArchEgz'));
        $manager->persist($this->createAssignment('Kontrolinis', 'KompArch', 40, 'KompArchKont'));
        $manager->persist($this->createAssignment('Egzaminas', 'SkaitiniaiMetodai', 100, 'SMEgz'));
        $manager->flush();
    }
    private function createAssignment($name, $subject, $weight, $reference) {
        $assignment = new Assignment();
        $assignment->setName($name);
        $assignment->setLectureType($this->getReference('Teorija'));
        $assignment->setSubject($this->getReference($subject));
        $assignment->setWeight($weight);
        $this->addReference($reference, $assignment);
        return $assignment;
    }
    public function getDependencies()
    {
        return [
            LectureTypeFixtures::class,
            SubjectFixtures::class,
        ];
    }
}
