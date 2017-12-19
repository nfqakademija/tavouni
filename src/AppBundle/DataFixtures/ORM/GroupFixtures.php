<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Group;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GroupFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createGroup('PS 3 kursas', 0, 'PS3k'));
        $manager->persist($this->createGroup('PS 3 kursas 3 grupė', 3, 'PS3k3g'));
        $manager->persist($this->createGroup('PS 3 kursas 6 grupė', 6, 'PS3k6g'));
        $manager->persist($this->createGroup('Skaitiniai metodai', 0, 'SM'));
        $manager->persist($this->createGroup('Skaitiniai metodai 1 grupė', 1, 'SM1g'));
        $manager->persist($this->createGroup('PS testavimas 1 grupė', 0, 'PST'));
        $manager->persist($this->createGroup('PS testavimas 1 grupė', 1, 'PST1g'));
        $manager->persist($this->createGroup('PS testavimas 2 grupė', 2, 'PST2g'));
        $manager->persist($this->createGroup('Appsai', 0, 'APP'));
        $manager->persist($this->createGroup('Appsai 1 grupė', 1, 'APP1g'));
        $manager->persist($this->createGroup('Appsai 2 grupė', 2, 'APP2g'));
        $manager->persist($this->createGroup('Kombinatorika', 0, 'KOM'));
        $manager->persist($this->createGroup('Funkcinis programavimas', 0, 'FUN'));
        $manager->persist($this->createGroup('Loginis programavimas', 0, 'LOG'));
        $manager->persist($this->createGroup('Kodavimo teorija', 0, 'KOD'));
        $manager->flush();
    }

    private function createGroup(string $name, int $number, string $reference): Group
    {
        $group = new Group($name, $number);
        $group->setName($name);
        $this->addReference($reference, $group);

        return $group;
    }
}
