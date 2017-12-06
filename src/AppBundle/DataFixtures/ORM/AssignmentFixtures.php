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
        $manager->persist($this->createAssignment(
            '1 laboratorinis darbas',
            'SkaitiniaiMetodai',
            20,
            'SM1l',
            new \DateTime('2017-10-16')
        ));
        $manager->persist($this->createAssignment(
            'Kontrolinis',
            'KompArch',
            40,
            'KompArchKont',
            new \DateTime('2017-12-06')
        ));
        $manager->persist($this->createAssignment(
            'Egzaminas',
            'KompArch',
            60,
            'KompArchEgz',
            new \DateTime('2017-12-07')
        ));
        $manager->persist($this->createAssignment(
            'Egzaminas',
            'SkaitiniaiMetodai',
            60,
            'SMEgz',
            new \DateTime('2017-12-07')
        ));
        $manager->persist($this->createAssignment(
            '2 laboratorinis darbas',
            'SkaitiniaiMetodai',
            20,
            'SM2l',
            new \DateTime('2017-12-07')
        ));
        $manager->persist($this->createAssignment(
            '3 laboratorinis darbas',
            'SkaitiniaiMetodai',
            20,
            'SM3l',
            new \DateTime('2017-12-08')
        ));
        $manager->persist($this->createAssignment(
            '4 laboratorinis darbas',
            'SkaitiniaiMetodai',
            20,
            'SM4l',
            new \DateTime('2017-12-20')
        ));
        $manager->flush();
    }
    private function createAssignment($name, $subject, $weight, $reference, $date)
    {
        $assignment = new Assignment(
            $this->getReference($subject),
            $weight,
            $name,
            $this->getReference('Teorija'),
            $date
        );
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
