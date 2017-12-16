<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Lecture
 *
 * @ORM\Table(name="lectures")
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
     * @var Group
     *
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="lectures")
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
     * @var String
     *
     * @ORM\Column(name="lecture_type", type="string", length=255)
     */
    private $lectureType;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Post", mappedBy="lecture")
     */
    private $posts;

    public function __construct()
    {
        $this->lectureDates = new ArrayCollection();
        $this->posts = new ArrayCollection();
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
     * @return Subject
     */
    public function getSubject(): Subject
    {
        return $this->subject;
    }

    /**
     * @param Subject $subject
     *
     * @return Lecture
     */
    public function setSubject(Subject $subject): Lecture
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return Lecturer
     */
    public function getLecturer(): Lecturer
    {
        return $this->lecturer;
    }

    /**
     * @param Lecturer $lecturer
     *
     * @return Lecture
     */
    public function setLecturer(Lecturer $lecturer): Lecture
    {
        $this->lecturer = $lecturer;

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
     * @return Lecture
     */
    public function setRoom(Room $room): Lecture
    {
        $this->room = $room;

        return $this;
    }

    /**
     * @return Group
     */
    public function getGroup(): Group
    {
        return $this->group;
    }

    /**
     * @param Group $group
     *
     * @return Lecture
     */
    public function setGroup(Group $group): Lecture
    {
        $this->group = $group;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getLectureDates(): ArrayCollection
    {
        return $this->lectureDates;
    }

    /**
     * @return string
     */
    public function getLectureType(): string
    {
        return $this->lectureType;
    }

    /**
     * @param string $lectureType
     *
     * @return Lecture
     */
    public function setLectureType(string $lectureType): Lecture
    {
        $this->lectureType = $lectureType;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getPosts(): ArrayCollection
    {
        return $this->posts;
    }

    /**
     * @param Post $post
     *
     * @return Lecture
     */
    public function addPost(Post $post): Lecture
    {
        $this->posts[] = $post;

        return $this;
    }
}
