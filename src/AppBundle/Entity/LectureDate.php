<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LectureDate
 *
 * @ORM\Table(name="lecture_date")
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
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var Lecture
     *
     * @ORM\ManyToOne(targetEntity="Lecture", inversedBy="lectureDates")
     * @ORM\JoinColumn(name="lecture_id", referencedColumnName="id", nullable=false)
     */
    private $lecture;


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return LectureDate
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
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
}
