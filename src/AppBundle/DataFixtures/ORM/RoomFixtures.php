<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RoomFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createRoom('102', 'Didl', '102didl'));
        $manager->persist($this->createRoom('101', 'Didl', '101didl'));
        $manager->persist($this->createRoom('101', 'Naug', '101naug'));
        $manager->flush();
    }

    private function createRoom(string $no, string $buildingRef, string $reference): Room
    {
        $room = new Room($no, $this->getReference($buildingRef));
        $this->addReference($reference, $room);

        return $room;
    }

    public function getDependencies()
    {
        return [
            BuildingFixtures::class,
        ];
    }
}
