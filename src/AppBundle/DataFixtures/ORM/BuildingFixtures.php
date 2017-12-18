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
        $manager->persist($this->createBuilding('MIF-Naug', 'Naugarduko g. 24', 'Naug'));
        $manager->persist($this->createBuilding('MIF-Didl', 'Didlaukio g. 47', 'Didl'));
        $manager->flush();
    }

    private function createBuilding(string $name, string $adress, string $ref): Building
    {
        $building = new Building($name, $adress);
        $this->addReference($ref, $building);

        return $building;
    }
}
