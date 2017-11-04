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
     * @var int
     *
     * @ORM\Column(name="lectureId", type="integer")
     */
    private $lectureId;


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
     * Set lectureId
     *
     * @param integer $lectureId
     *
     * @return LectureDate
     */
    public function setLectureId($lectureId)
    {
        $this->lectureId = $lectureId;

        return $this;
    }

    /**
     * Get lectureId
     *
     * @return int
     */
    public function getLectureId()
    {
        return $this->lectureId;
    }
}

