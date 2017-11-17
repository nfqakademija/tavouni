<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Student
     *
     * @ORM\OneToOne(targetEntity="Student", mappedBy="user")
     */
    private $student;

    /**
     * @var Lecturer
     *
     * @ORM\OneToOne(targetEntity="Lecturer", mappedBy="user")
     */
    private $lecturer;

    public function __construct()
    {
        parent::__construct();
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
     * @return Student
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param Student $student
     */
    public function setStudent($student)
    {
        $this->student = $student;
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
