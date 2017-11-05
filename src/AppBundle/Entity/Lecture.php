<?php

namespace AppBundle\Entity;

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
     * @var int
     *
     * @ORM\Column(name="groupId", type="integer")
     */
    private $groupId;

    /**
     * @var int
     *
     * @ORM\Column(name="roomId", type="integer")
     */
    private $roomId;


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
     * Set groupId
     *
     * @param integer $groupId
     *
     * @return Lecture
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * Get groupId
     *
     * @return int
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * Set roomId
     *
     * @param integer $roomId
     *
     * @return Lecture
     */
    public function setRoomId($roomId)
    {
        $this->roomId = $roomId;

        return $this;
    }

    /**
     * Get roomId
     *
     * @return int
     */
    public function getRoomId()
    {
        return $this->roomId;
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
}
