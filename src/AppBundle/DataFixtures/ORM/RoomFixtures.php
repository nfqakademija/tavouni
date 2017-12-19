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
//        $manager->persist($this->createRoom('102', 'Didl'));
//        $manager->persist($this->createRoom('101', 'Didl'));
//        $manager->persist($this->createRoom('101', 'Naug'));
        $this->createRooms('didl', $manager);
        $this->createRooms('naug', $manager);
        $this->createRooms('CH', $manager);
        $this->createRooms('salt', $manager);
        $this->createRooms('KF', $manager);
        $this->createRooms('FF', $manager);
        $this->createRooms('FL', $manager);
        $this->createRooms('IS', $manager);
        $this->createRooms('FZ', $manager);
        $this->createRooms('GM', $manager);
        $this->createRooms('MED', $manager);
        $manager->flush();
    }

    private function createRoom(string $no, string $buildingRef): Room
    {
        $room = new Room($no, $this->getReference($buildingRef));
        $this->addReference($no . $buildingRef, $room);

        return $room;
    }

    private function createRooms(string $buildingRef, ObjectManager $manager)
    {
        $rooms = [];
        $rooms[] = $this->createRoom('101', $buildingRef);
        $rooms[] = $this->createRoom('102', $buildingRef);
        $rooms[] = $this->createRoom('201', $buildingRef);
        $rooms[] = $this->createRoom('202', $buildingRef);
        $rooms[] = $this->createRoom('203', $buildingRef);
        $rooms[] = $this->createRoom('204', $buildingRef);
        $rooms[] = $this->createRoom('205', $buildingRef);
        $rooms[] = $this->createRoom('301', $buildingRef);
        $rooms[] = $this->createRoom('302', $buildingRef);
        foreach ($rooms as $room) {
            $manager->persist($room);
        }
    }

    public function getDependencies()
    {
        return [
            BuildingFixtures::class,
        ];
    }
}
