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
        $manager->persist($this->createRoom('102', 'Didl', '102didl'));
        $manager->persist($this->createRoom('101', 'Didl', '101didl'));
        $manager->flush();
    }
    private function createRoom($no, $building, $ref) {
        $room = new Room();
        $room->setNo($no);
        $room->setBuilding($this->getReference($building));
        $this->addReference($ref, $room);
        return $room;
    }
    public function getDependencies()
    {
        return [
            BuildingFixtures::class,
        ];
    }
}
