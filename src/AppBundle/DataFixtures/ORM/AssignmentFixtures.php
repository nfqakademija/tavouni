<?php

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
            new \DateTime('2017-10-16'),
            'Pratybos'
        ));
        $manager->persist($this->createAssignment(
            'Kontrolinis',
            'KompArch',
            40,
            'KompArchKont',
            new \DateTime('2017-12-06'),
            'Teorija'
        ));
        $manager->persist($this->createAssignment(
            'Egzaminas',
            'KompArch',
            60,
            'KompArchEgz',
            new \DateTime('2017-12-07'),
            'Teorija'
        ));
        $manager->persist($this->createAssignment(
            'Egzaminas',
            'SkaitiniaiMetodai',
            80,
            'SMEgz',
            new \DateTime('2017-12-07'),
            'Teorija'
        ));
        $manager->persist($this->createAssignment(
            '2 laboratorinis darbas',
            'SkaitiniaiMetodai',
            20,
            'SM2l',
            new \DateTime('2017-12-07'),
            'Pratybos'
        ));
        $manager->persist($this->createAssignment(
            '3 laboratorinis darbas',
            'SkaitiniaiMetodai',
            20,
            'SM3l',
            new \DateTime('2017-12-08'),
            'Pratybos'
        ));
        $manager->persist($this->createAssignment(
            '4 laboratorinis darbas',
            'SkaitiniaiMetodai',
            20,
            'SM4l',
            new \DateTime('2017-12-20'),
            'Pratybos'
        ));
        $manager->flush();
    }

    private function createAssignment(
        string $name,
        string $subjectRef,
        int $weight,
        string $reference,
        \DateTime $date,
        string $typeRef
    ): Assignment {
        $assignment = new Assignment(
            $this->getReference($subjectRef),
            $weight,
            $name,
            $typeRef,
            $date
        );
        $this->addReference($reference, $assignment);

        return $assignment;
    }

    public function getDependencies(): array
    {
        return [
            SubjectFixtures::class,
        ];
    }
}
