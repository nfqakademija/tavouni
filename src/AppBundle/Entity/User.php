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
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Student
     */
    public function getStudent(): Student
    {
        return $this->student;
    }

    /**
     * @param Student $student
     *
     * @return User
     */
    public function setStudent($student): User
    {
        $this->student = $student;

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
     * @return User
     */
    public function setLecturer($lecturer): User
    {
        $this->lecturer = $lecturer;

        return $this;
    }
}
