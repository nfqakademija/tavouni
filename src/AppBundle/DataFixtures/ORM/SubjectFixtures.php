<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Subject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SubjectFixtures extends Fixture
{
    public static $subjects;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this::$subjects = [
            [
                'name' => 'Skaitiniai metodai',
                'type' => 'Pasirenkamasis',
                'reference' => 'SSM',
                'coordinatorRef' => 'LOlgaŠtikonienė'
            ],
            [
                'name' => 'Programų sistemų projektavimas',
                'type' => 'Privalomasis',
                'reference' => 'SPSP',
                'coordinatorRef' => 'LMindaugasPlukas'
            ],
            [
                'name' => 'Programų sistemų testavimas',
                'type' => 'Privalomasis',
                'reference' => 'SPST',
                'coordinatorRef' => 'LVytautasValaitis'
            ],
            [
                'name' => 'Mobiliųjų aplikacijų kūrimas',
                'type' => 'Pasirenkamasis',
                'reference' => 'SAPP',
                'coordinatorRef' => 'LMindaugasEglinskas'
            ],
            [
                'name' => 'Žmogaus ir kompiuterio sąveika',
                'type' => 'Privalomasis',
                'reference' => 'SŽKS',
                'coordinatorRef' => 'LKristinaLapin'
            ],
            [
                'name' => 'Interneto technologijos',
                'type' => 'Privalomasis',
                'reference' => 'SIT',
                'coordinatorRef' => 'LVaidasJusevičius'
            ],
            [
                'name' => 'Funkcinis programavimas',
                'type' => 'Pasirenkamasis',
                'reference' => 'SFUN',
                'coordinatorRef' => 'LViačiaslavPozdniakov'
            ],
            [
                'name' => 'Loginis programavimas',
                'type' => 'Pasirenkamasis',
                'reference' => 'SLOG',
                'coordinatorRef' => 'LViačiaslavPozdniakov'
            ],
            [
                'name' => 'Kombinatorika',
                'type' => 'Pasirenkamasis',
                'reference' => 'SKOM',
                'coordinatorRef' => 'LGintarasSkersys'
            ],
            [
                'name' => 'Kodavimo teorija',
                'type' => 'Pasirenkamasis',
                'reference' => 'SKOD',
                'coordinatorRef' => 'LGintarasSkersys'
            ]
        ];

        foreach ($this::$subjects as $subject) {
            $manager->persist($this->createSubject(
                $subject['name'],
                $subject['type'],
                $subject['reference'],
                $subject['coordinatorRef']
            ));
        }
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
