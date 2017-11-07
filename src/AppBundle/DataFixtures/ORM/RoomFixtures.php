<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.7
 * Time: 13.49
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RoomFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $room = new Room();
        $room->setNo('101');
        $room->setBuilding($this->getReference('Didl'));
        $manager->persist($room);
        $manager->flush();
        $this->addReference('101didl', $room);
    }
    public function getDependencies()
    {
        return array(
            BuildingFixtures::class,
        );
    }
}