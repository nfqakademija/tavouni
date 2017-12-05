<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set no
     *
     * @param string $no
     *
     * @return Room
     */
    public function setNo($no)
    {
        $this->no = $no;

        return $this;
    }

    /**
     * Get no
     *
     * @return string
     */
    public function getNo()
    {
        return $this->no;
    }

    /**
     * @return mixed
     */
    public function getLectures()
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
     * @param ArrayCollection $assignmentEvents
     */
    public function setAssignmentEvents(ArrayCollection $assignmentEvents)
    {
        $this->assignmentEvents = $assignmentEvents;
    }

    /**
     * @param mixed $lectures
     */
    public function setLectures($lectures)
    {
        $this->lectures = $lectures;
    }

    /**
     * @return Building
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * @param Building $building
     */
    public function setBuilding($building)
    {
        $this->building = $building;
    }
}
