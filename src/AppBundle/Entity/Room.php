<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="rooms")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoomRepository")
 */
class Room
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="no", type="string", length=255)
     */
    private $no;

    /**
     * @var Building
     *
     * @ORM\ManyToOne(targetEntity="Building", inversedBy="rooms")
     * @ORM\JoinColumn(name="building_id", referencedColumnName="id")
     */
    private $building;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Lecture", mappedBy="room")
     */
    private $lectures;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AssignmentEvent", mappedBy="room")
     */
    private $assignmentEvents;

    /**
     * @param string $no
     * @param Building $building
     */
    public function __construct(string $no, Building $building)
    {
        $this->no = $no;
        $this->building = $building;
        $this->lectures = new ArrayCollection();
        $this->assignmentEvents = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $no
     *
     * @return Room
     */
    public function setNo(string $no): Room
    {
        $this->no = $no;

        return $this;
    }

    /**
     * @return string
     */
    public function getNo(): string
    {
        return $this->no;
    }

    /**
     * @return ArrayCollection
     */
    public function getLectures(): ArrayCollection
    {
        return $this->lectures;
    }

    /**
     * @return ArrayCollection
     */
    public function getAssignmentEvents(): ArrayCollection
    {
        return $this->assignmentEvents;
    }

    /**
     * @return Building
     */
    public function getBuilding(): Building
    {
        return $this->building;
    }

    /**
     * @param Building $building
     *
     * @return Room
     */
    public function setBuilding(Building $building): Room
    {
        $this->building = $building;

        return $this;
    }
}
