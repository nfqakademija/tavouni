<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Building;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BuildingFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createBuilding('MIF-Naug', 'Naugarduko g. 24', 'naug'));
        $manager->persist($this->createBuilding('CH-Naug', 'Naugarduko g. 23', 'CH'));
        $manager->persist($this->createBuilding('MIF-Didl', 'Didlaukio g. 47', 'didl'));
        $manager->persist($this->createBuilding('MIF-Šalt', 'Šaltinių g. 1', 'salt'));
        $manager->persist($this->createBuilding('KF-Saul', 'Saulėtekio al. 1', 'KF'));
        $manager->persist($this->createBuilding('FF-Uni', 'Universiteto g. 4', 'FF'));
        $manager->persist($this->createBuilding('FL-Uni', 'Universiteto g. 5', 'FL'));
        $manager->persist($this->createBuilding('IS-Uni', 'Universiteto g. 6', 'IS'));
        $manager->persist($this->createBuilding('FZ-Saul', 'Saulėtekio al. 2', 'FZ'));
        $manager->persist($this->createBuilding('GM-Čiurl', 'M. K. Čiurlionio g. 21', 'GM'));
        $manager->persist($this->createBuilding('MED-Čiurl', 'M. K. Čiurlionio g. 22', 'MED'));
        $manager->flush();
    }

    private function createBuilding(string $name, string $adress, string $ref): Building
    {
        $building = new Building($name, $adress);
        $this->addReference($ref, $building);

        return $building;
    }
}
