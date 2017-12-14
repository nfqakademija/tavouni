<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Building;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BuildingFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $building = new Building();
        $building->setName("MIF-Naug");
        $building->setAddress("Naugarduko g. 24");
        $manager->persist($building);
        $building2 = new Building();
        $building2->setName("MIF-Didl");
        $building2->setAddress("Didlaukio g. 47");
        $manager->persist($building2);
        $manager->flush();
        $this->addReference('Naug', $building);
        $this->addReference('Didl', $building2);
    }
}
