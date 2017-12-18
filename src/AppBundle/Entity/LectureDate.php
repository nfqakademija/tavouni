<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="lecture_dates")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LectureDateRepository")
 */
class LectureDate
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
     * @var Lecture
     *
     * @ORM\ManyToOne(targetEntity="Lecture", inversedBy="lectureDates")
     * @ORM\JoinColumn(name="lecture_id", referencedColumnName="id", nullable=false)
     */
    private $lecture;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     * @return LectureDate
     */
    public function setLecture(Lecture $lecture): LectureDate
    {
        $this->lecture = $lecture;

        return $this;
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
     * @return LectureDate
     */
    public function setStart($start): LectureDate
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
     * @return LectureDate
     */
    public function setEnd($end): LectureDate
    {
        $this->end = $end;

        return $this;
    }
}
