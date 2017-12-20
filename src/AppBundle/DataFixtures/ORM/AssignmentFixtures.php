<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Assignment;
use AppBundle\Entity\AssignmentEvent;
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
                $randomDate = $this->getRandomDate(new \DateTime('2017-10-15'), new \DateTime('2017-11-28'));
                $startTime = (clone $randomDate)->add(new \DateInterval('PT' . random_int(8, 18) . 'H'));
                $assignmentEvent = $this->createAssignmentEvent($startTime, '205naug');
                $manager->persist($assignmentEvent);
                $manager->persist($this->createAssignment(
                    'Kontrolinis',
                    $subject['reference'],
                    $assignWeight,
                    $subject['reference'] . 'Kol',
                    $randomDate,
                    'Teorija',
                    $assignmentEvent
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

            $randomDate = $this->getRandomDate(new \DateTime('2018-01-02'), new \DateTime('2018-01-31'));
            $startTime = (clone $randomDate)->add(new \DateInterval('PT' . random_int(8, 18) . 'H'));
            $assignmentEvent = $this->createAssignmentEvent($startTime, '102naug');
            $manager->persist($assignmentEvent);
            $manager->persist($this->createAssignment(
                'Egzaminas',
                $subject['reference'],
                $weight,
                $subject['reference'] . 'Egz',
                $randomDate,
                'Teorija',
                $assignmentEvent
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
        string $type,
        AssignmentEvent $assignmentEvent = null
    ): Assignment {
        $assignment = new Assignment(
            $this->getReference($subjectRef),
            $weight,
            $name,
            $type,
            $date,
            $assignmentEvent
        );
        $this->addReference($reference, $assignment);

        return $assignment;
    }

    private function createAssignmentEvent(\DateTime $startTime, string $roomRef)
    {
        return new AssignmentEvent(
            $startTime,
            $startTime->add(new \DateInterval('PT2H')),
            $this->getReference($roomRef)
        );
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
