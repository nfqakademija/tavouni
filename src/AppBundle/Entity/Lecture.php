<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Lecture
 *
 * @ORM\Table(name="lecture")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LectureRepository")
 */
class Lecture
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
     * @var Subject
     *
     * @ORM\ManyToOne(targetEntity="Subject", inversedBy="lectures")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id", nullable=false)
     */
    private $subject;

    /**
     * @var Lecturer
     *
     * @ORM\ManyToOne(targetEntity="Lecturer", inversedBy="lectures")
     * @ORM\JoinColumn(name="lecturer_id", referencedColumnName="id", nullable=false)
     */
    private $lecturer;

    /**
     * @var Group_
     *
     * @ORM\ManyToOne(targetEntity="Group_", inversedBy="lectures")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id", nullable=false)
     */
    private $group;

    /**
     * @var Room
     *
     * @ORM\ManyToOne(targetEntity="Room", inversedBy="lectures")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id", nullable=false)
     */
    private $room;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="LectureDate", mappedBy="lecture"))
     */
    private $lectureDates;


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
     * @return Subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param Subject $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return Lecturer
     */
    public function getLecturer()
    {
        return $this->lecturer;
    }

    /**
     * @param Lecturer $lecturer
     */
    public function setLecturer($lecturer)
    {
        $this->lecturer = $lecturer;
    }

    /**
     * @return Room
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * @param Room $room
     */
    public function setRoom($room)
    {
        $this->room = $room;
    }

    /**
     * @return Group_
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param Group_ $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }
}
