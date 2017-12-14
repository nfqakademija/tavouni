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
     *
     * @param string $title
     * @param string $content
     * @param Lecture $lecture
     * @param Lecturer $author
     */
    public function __construct(string $title, string $content, Lecture $lecture, Lecturer $author)
    {
        $this->title = $title;
        $this->content = $content;
        $this->lecture = $lecture;
        $this->author = $author;
        $this->publishedAt = new \DateTime();
        $this->seenByStudents = new ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle(string $title): Post
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): string
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
    public function setContent(string $content): Post
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent(): string
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
    public function setPublishedAt(\DateTime $publishedAt): Post
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getPublishedAt(): \DateTime
    {
        return $this->publishedAt;
    }

    /**
     * @return Lecture
     */
    public function getLecture(): Lecture
    {
        return $this->lecture;
    }

    /**
     * @param Lecture $lecture
     *
     * @return Post
     */
    public function setLecture(Lecture $lecture): Post
    {
        $this->lecture = $lecture;

        return $this;
    }

    /**
     * @return Lecturer
     */
    public function getAuthor(): Lecturer
    {
        return $this->author;
    }

    /**
     * @param Lecturer $author
     *
     * @return Post
     */
    public function setAuthor(Lecturer $author): Post
    {
        $this->author = $author;

        return $this;
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
     *
     * @return Post
     */
    public function addSeenByStudent(Student $student): Post
    {
        $this->seenByStudents[] = $student;

        return $this;
    }
}
