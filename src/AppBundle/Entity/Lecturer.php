<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Lecturer
 *
 * @ORM\Table(name="lecturers")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LecturerRepository")
 */
class Lecturer
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Lecture", mappedBy="lecturer")
     */
    private $lectures;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Post", mappedBy="author")
     */
    private $posts;

    /**
     * @var User
     *
     * @ORM\OneToOne(targetEntity="User", inversedBy="lecturer")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Subject", mappedBy="coordinator")
     */
    private $subjects;

    public function __construct()
    {
        $this->lectures = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->subjects = new ArrayCollection();
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
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Lecturer
     */
    public function setName(string $name): Lecturer
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSubjects(): ArrayCollection
    {
        return $this->subjects;
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
    public function getPosts(): ArrayCollection
    {
        return $this->posts;
    }

    /**
     * @param Post $post
     *
     * @return Lecturer
     */
    public function addPost(Post $post): Lecturer
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return Lecturer
     */
    public function setUser(User $user): Lecturer
    {
        $this->user = $user;

        return $this;
    }
}
