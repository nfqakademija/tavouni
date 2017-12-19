<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Lecture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LectureFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $lectures = [
            [
                'groupRef' => 'SM',
                'subjectRef' => 'SSM',
                'lecturerRef' => 'LOlgaŠtikonienė',
                'reference' => 'LSM',
                'lectureType' => 'Teorija'
            ],
            [
                'groupRef' => 'SM',
                'subjectRef' => 'SSM',
                'lecturerRef' => 'LOlgaŠtikonienė',
                'reference' => 'LSML',
                'lectureType' => 'Laboratoriniai darbai'
            ],
            [
                'groupRef' => 'PS3k',
                'subjectRef' => 'SPSP',
                'lecturerRef' => 'LMindaugasPlukas',
                'reference' => 'LPSP',
                'lectureType' => 'Teorija'
            ],
            [
                'groupRef' => 'PS3k3g',
                'subjectRef' => 'SPSP',
                'lecturerRef' => 'LMindaugasKarpinskas',
                'reference' => 'LPSPL3g',
                'lectureType' => 'Laboratorinai darbai'
            ],
            [
                'groupRef' => 'PS3k6g',
                'subjectRef' => 'SPSP',
                'lecturerRef' => 'LGiedriusGraževičius',
                'reference' => 'LPSPL6g',
                'lectureType' => 'Laboratorinai darbai'
            ],
            [
                'groupRef' => 'PST',
                'subjectRef' => 'SPST',
                'lecturerRef' => 'LVytautasValaitis',
                'reference' => 'LPST',
                'lectureType' => 'Teorija'
            ],
            [
                'groupRef' => 'PST1g',
                'subjectRef' => 'SPST',
                'lecturerRef' => 'LVytautasValaitis',
                'reference' => 'LPSTL1g',
                'lectureType' => 'Laboratoriniai darbai'
            ],
            [
                'groupRef' => 'PST2g',
                'subjectRef' => 'SPST',
                'lecturerRef' => 'LVytautasValaitis',
                'reference' => 'LPSTL2g',
                'lectureType' => 'Laboratoriniai darbai'
            ],
            [
                'groupRef' => 'APP',
                'subjectRef' => 'SAPP',
                'lecturerRef' => 'LMindaugasEglinskas',
                'reference' => 'LAPP',
                'lectureType' => 'Teorija'
            ],
            [
                'groupRef' => 'APP1g',
                'subjectRef' => 'SAPP',
                'lecturerRef' => 'LMindaugasEglinskas',
                'reference' => 'LAPPL1g',
                'lectureType' => 'Laboratoriniai darbai'
            ],
            [
                'groupRef' => 'APP2g',
                'subjectRef' => 'SAPP',
                'lecturerRef' => 'LMindaugasEglinskas',
                'reference' => 'LAPPL2g',
                'lectureType' => 'Laboratoriniai darbai'
            ],
            [
                'groupRef' => 'PS3k',
                'subjectRef' => 'SŽKS',
                'lecturerRef' => 'LKristinaLapin',
                'reference' => 'LŽKS',
                'lectureType' => 'Teorija'
            ],
            [
                'groupRef' => 'PS3k6g',
                'subjectRef' => 'SŽKS',
                'lecturerRef' => 'LKristinaLapin',
                'reference' => 'LŽKSL6g',
                'lectureType' => 'Laboratoriniai darbai'
            ],
            [
                'groupRef' => 'PS3k3g',
                'subjectRef' => 'SŽKS',
                'lecturerRef' => 'LTomasTumasonis',
                'reference' => 'LŽKSL3g',
                'lectureType' => 'Laboratoriniai darbai'
            ],
            [
                'groupRef' => 'PS3k',
                'subjectRef' => 'SIT',
                'lecturerRef' => 'LVaidasJusevičius',
                'reference' => 'LIT',
                'lectureType' => 'Teorija'
            ],
            [
                'groupRef' => 'PS3k3g',
                'subjectRef' => 'SIT',
                'lecturerRef' => 'LJustinasMarcinka',
                'reference' => 'LITL3g',
                'lectureType' => 'Laboratoriniai darbai'
            ],
            [
                'groupRef' => 'FUN',
                'subjectRef' => 'SFUN',
                'lecturerRef' => 'LViačiaslavPozdniakov',
                'reference' => 'LFUN',
                'lectureType' => 'Teorija'
            ],
            [
                'groupRef' => 'LOG',
                'subjectRef' => 'SLOG',
                'lecturerRef' => 'LViačiaslavPozdniakov',
                'reference' => 'LLOG',
                'lectureType' => 'Teorija'
            ],
            [
                'groupRef' => 'KOM',
                'subjectRef' => 'SKOM',
                'lecturerRef' => 'LGintarasSkersys',
                'reference' => 'LKOM',
                'lectureType' => 'Teorija'
            ],
            [
                'groupRef' => 'KOM',
                'subjectRef' => 'SKOM',
                'lecturerRef' => 'LGintarasSkersys',
                'reference' => 'LKOMP',
                'lectureType' => 'Pratybos'
            ],
            [
                'groupRef' => 'KOD',
                'subjectRef' => 'SKOD',
                'lecturerRef' => 'LGintarasSkersys',
                'reference' => 'LKOD',
                'lectureType' => 'Teorija'
            ],
            [
                'groupRef' => 'KOD',
                'subjectRef' => 'SKOD',
                'lecturerRef' => 'LGintarasSkersys',
                'reference' => 'LKODP',
                'lectureType' => 'Pratybos'
            ]
        ];
        foreach ($lectures as $lecture) {
            $manager->persist($this->createLecture(
                $lecture['groupRef'],
                $lecture['subjectRef'],
                $lecture['lecturerRef'],
                $lecture['reference'],
                $lecture['lectureType']
            ));
        }
        $manager->flush();
        $manager->flush();
    }

    private function createLecture(
        string $groupRef,
        string $subjectRef,
        string $lecturerRef,
        string $reference,
        string $lectureType
    ): Lecture {
        $lecture = new Lecture(
            $this->getReference($subjectRef),
            $this->getReference($lecturerRef),
            $this->getReference($groupRef),
            $this->getReference('101didl'),
            $lectureType
        );
        $this->addReference($reference, $lecture);

        return $lecture;
    }

    public function getDependencies(): array
    {
        return [
            RoomFixtures::class,
            GroupFixtures::class,
            SubjectFixtures::class,
            LecturerFixtures::class,
        ];
    }
}
