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
     * @var int
     *
     * @ORM\Column(name="subjectId", type="integer")
     */
    private $subjectId;

    /**
     * @var int
     *
     * @ORM\Column(name="lecturerId", type="integer")
     */
    private $lecturerId;

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
     * Set subjectId
     *
     * @param integer $subjectId
     *
     * @return Lecture
     */
    public function setSubjectId($subjectId)
    {
        $this->subjectId = $subjectId;

        return $this;
    }

    /**
     * Get subjectId
     *
     * @return int
     */
    public function getSubjectId()
    {
        return $this->subjectId;
    }

    /**
     * Set lecturerId
     *
     * @param integer $lecturerId
     *
     * @return Lecture
     */
    public function setLecturerId($lecturerId)
    {
        $this->lecturerId = $lecturerId;

        return $this;
    }

    /**
     * Get lecturerId
     *
     * @return int
     */
    public function getLecturerId()
    {
        return $this->lecturerId;
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
}

