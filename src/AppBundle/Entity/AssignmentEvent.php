<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AssignmentEvent
 *
 * @ORM\Table(name="assignment_events")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AssignmentEventRepository")
 */
class AssignmentEvent
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
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="datetime")
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="datetime")
     */
    private $end;

    /**
     * @var Room
     *
     * @ORM\ManyToOne(targetEntity="Room", inversedBy="assignmentEvents")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id", nullable=false)
     */
    private $room;

    /**
     * @var Assignment
     *
     * @ORM\OneToOne(targetEntity="Assignment", mappedBy="assignmentEvent")
     */
    private $assignment;

    /**
     * AssignmentEvent constructor.
     * @param \DateTime $start
     * @param \DateTime $end
     * @param Room $room
     */
    public function __construct(\DateTime $start, \DateTime $end, Room $room)
    {
        $this->start = $start;
        $this->end = $end;
        $this->room = $room;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */

    public function getStart(): \DateTime
    {
        return $this->start;
    }

    /**
     * @param \DateTime $start
     *
     * @return AssignmentEvent
     */
    public function setStart(\DateTime $start): AssignmentEvent
    {
        $this->start = $start;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEnd(): \DateTime
    {
        return $this->end;
    }

    /**
     * @param \DateTime $end
     *
     * @return AssignmentEvent
     */
    public function setEnd(\DateTime $end): AssignmentEvent
    {
        $this->end = $end;

        return $this;
    }

    /**
     * @return Room
     */
    public function getRoom(): Room
    {
        return $this->room;
    }

    /**
     * @param Room $room
     *
     * @return AssignmentEvent
     */
    public function setRoom(Room $room): AssignmentEvent
    {
        $this->room = $room;

        return $this;
    }

    /**
     * @return Assignment
     */
    public function getAssignment(): Assignment
    {
        return $this->assignment;
    }

    /**
     * @param Assignment $assignment
     *
     * @return AssignmentEvent
     */
    public function setAssignment(Assignment $assignment): AssignmentEvent
    {
        $this->assignment = $assignment;

        return $this;
    }
}
