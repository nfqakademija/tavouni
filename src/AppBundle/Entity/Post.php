<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="posts")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 */
class Post
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publishedAt", type="datetime")
     */
    private $publishedAt;

    /**
     * @var Lecture
     *
     * @ORM\ManyToOne(targetEntity="Lecture", inversedBy="posts")
     * @ORM\JoinColumn(name="lecture_id", referencedColumnName="id")
     */
    private $lecture;

    /**
     * @var Lecturer
     *
     * @ORM\ManyToOne(targetEntity="Lecturer", inversedBy="posts")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Student")
     * @ORM\JoinTable(name="seen_posts_students")
     */
    private $seenByStudents;

    /**
     * Post constructor.
     * @param int $id
     * @param string $title
     * @param string $content
     * @param Lecture $lecture
     * @param Lecturer $author
     * @param Collection $seenByStudents
     */
    public function __construct($title, $content, Lecture $lecture, Lecturer $author)
    {
        $this->title = $title;
        $this->content = $content;
        $this->publishedAt = new \DateTime();
        $this->lecture = $lecture;
        $this->author = $author;
        $this->seenByStudents = new ArrayCollection();
    }


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
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     *
     * @return Post
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @return Lecture
     */
    public function getLecture()
    {
        return $this->lecture;
    }

    /**
     * @param Lecture $lecture
     */
    public function setLecture($lecture)
    {
        $this->lecture = $lecture;
    }

    /**
     * @return Lecturer
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param Lecturer $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return Collection
     */
    public function getSeenByStudents(): Collection
    {
        return $this->seenByStudents;
    }

    /**
     * @param Student $student
     */
    public function addSeenByStudent(Student $student)
    {
        $this->seenByStudents[] = $student;
    }
}
