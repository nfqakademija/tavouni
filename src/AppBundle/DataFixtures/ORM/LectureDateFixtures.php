<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\LectureDate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LectureDateFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //$manager->persist($this->createLectureDate('KompArchTeor', new \DateTime('2017-11-23T14:00')));
        $this->createEachWeek('LSM', new \DateTime('2017-09-04T12:00'), $manager, 16);
        $this->createEachWeek('LPST', new \DateTime('2017-09-06T10:00'), $manager, 16);
        $this->createEachWeek('LŽKS', new \DateTime('2017-09-08T12:00'), $manager, 16);
        $this->createEachWeek('LIT', new \DateTime('2017-09-06T14:00'), $manager, 16);
        $this->createEachWeek('LFUN', new \DateTime('2017-09-05T16:00'), $manager, 16);
        $this->createEachWeek('LPSP', new \DateTime('2017-09-07T14:00'), $manager, 16);
        $this->createEachWeek('LPSPL3g', new \DateTime('2017-09-07T16:00'), $manager, 16);
        $this->createEachWeek('LSML', new \DateTime('2017-09-04T14:00'), $manager, 16);
        $this->createEachWeek('LPSTL1g', new \DateTime('2017-09-06T08:00'), $manager, 16);
        $this->createEachWeek('LPSTL2g', new \DateTime('2017-09-06T12:00'), $manager, 16);
        $this->createEachWeek('LŽKSL3g', new \DateTime('2017-09-08T14:00'), $manager, 16);
        $this->createEachWeek('LITL3g', new \DateTime('2017-09-08T16:00'), $manager, 16);
        //$this->createEachWeek('LPSP', new \DateTime('2017-09-07T14:00'), $manager, 16);
//        $manager->persist($this->createLectureDate('KompArchTeor', new \DateTime('2017-11-30T14:00')));
//        $manager->persist($this->createLectureDate('KompArchTeor', new \DateTime('2017-11-16T14:00')));
//        $manager->persist($this->createLectureDate('SMTeor', new \DateTime('2017-11-30T10:00')));
//        $manager->persist($this->createLectureDate('SMTeor', new \DateTime('2017-11-16T10:00')));
//        $manager->persist($this->createLectureDate('SMTeor', new \DateTime('2017-11-23T10:00')));
        $manager->flush();
    }

    private function createLectureDate(string $lectureRef, \DateTime $start): LectureDate
    {
        $lectureDate = new LectureDate(
            $start,
            (clone $start)->add(new \DateInterval('PT2H')),
            $this->getReference($lectureRef)
        );

        return $lectureDate;
    }

    private function createEachWeek(string $lectureRef, \DateTime $date, ObjectManager $manager, int $n)
    {
        for ($i = 0; $i < $n; $i++) {
            $start = (clone $date);
            $end = (clone $date)->add(new \DateInterval('PT2H'));
            $lectureDate = new LectureDate(
                $start,
                $end,
                $this->getReference($lectureRef)
            );
            $manager->persist($lectureDate);
            $date = $date->add(new \DateInterval('P7D'));
        }
    }

    public function getDependencies(): array
    {
        return [
            LectureFixtures::class,
        ];
    }
}
