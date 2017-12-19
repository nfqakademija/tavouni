<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Assignment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AssignmentFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach (SubjectFixtures::$subjects as $subject) {
            $weight = 100;

            $assignWeight = random_int(5, 30);
            $manager->persist($this->createAssignment(
                '1 lab. darbas',
                $subject['reference'],
                $assignWeight,
                $subject['reference'] . '1l',
                $this->getRandomDate(new \DateTime('2017-09-20'), new \DateTime('2017-10-10')),
                'Laboratoriniai darbai'
            ));
            $weight -= $assignWeight;

            $assignWeight = random_int(5, 30);
            $manager->persist($this->createAssignment(
                '2 lab. darbas',
                $subject['reference'],
                $assignWeight,
                $subject['reference'] . '2l',
                $this->getRandomDate(new \DateTime('2017-10-12'), new \DateTime('2017-11-01')),
                'Laboratoriniai darbai'
            ));
            $weight -= $assignWeight;

            if (random_int(0, 1)) {
                $assignWeight = random_int(5, 30);
                $manager->persist($this->createAssignment(
                    'Kontrolinis',
                    $subject['reference'],
                    $assignWeight,
                    $subject['reference'] . 'Kol',
                    $this->getRandomDate(new \DateTime('2017-10-15'), new \DateTime('2017-11-28')),
                    'Teorija'
                ));
                $weight -= $assignWeight;
            }

            if (random_int(0, 1)) {
                $assignWeight = random_int(5, 30);
                $manager->persist($this->createAssignment(
                    '3 lab. darbas',
                    $subject['reference'],
                    $assignWeight,
                    $subject['reference'] . '3l',
                    $this->getRandomDate(new \DateTime('2017-11-30'), new \DateTime('2017-12-22')),
                    'Laboratoriniai darbai'
                ));
                $weight -= $assignWeight;
            }

            $manager->persist($this->createAssignment(
                'Egzaminas',
                $subject['reference'],
                $weight,
                $subject['reference'] . 'Egz',
                $this->getRandomDate(new \DateTime('2018-01-02'), new \DateTime('2018-01-31')),
                'Teorija'
            ));

            $manager->flush();
        }
    }

    private function createAssignment(
        string $name,
        string $subjectRef,
        int $weight,
        string $reference,
        \DateTime $date,
        string $type
    ): Assignment {
        $assignment = new Assignment(
            $this->getReference($subjectRef),
            $weight,
            $name,
            $type,
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

    private function getRandomDate(\DateTime $startDate, \DateTime $endDate)
    {
        $min = $startDate->getTimestamp();
        $max = $endDate->getTimestamp();
        
        do {
            $val = random_int($min, $max);
            $date = new \DateTime(date('Y-m-d', $val));
        } while ($date->format('N') >= 6);

        return $date;
    }
}
