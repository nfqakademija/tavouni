<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Subject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SubjectFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createSubject(
            'Kompiuterių architektūra',
            'Privalomas',
            'KompArch',
            'LecturerAntanas'
        ));
        $manager->persist($this->createSubject(
            'Skaitiniai metodai',
            'Pasirenkamasis',
            'SkaitiniaiMetodai',
            'LecturerOlga'
        ));
        $manager->flush();
    }

    private function createSubject(
        string $name,
        string $type,
        string $reference,
        string $coordinatorRef
    ): Subject {
        $subject = new Subject($type, $name, $this->getReference($coordinatorRef));
        $this->addReference($reference, $subject);

        return $subject;
    }

    public function getDependencies(): array
    {
        return [
            LecturerFixtures::class,
        ];
    }
}
