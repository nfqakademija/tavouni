<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
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

    /**
     * @var string
     *
     * @ORM\Column(name="api_key", type="string", unique=true)
     */
    private $apiKey;

    /**
     * @param string $username
     * @param string $plainPassword
     * @param array $roles
     * @param bool $enabled
     * @param string $email
     * @param string $apiKey
     */
    public function __construct(
        string $username,
        string $plainPassword,
        array $roles,
        bool $enabled,
        string $email,
        string $apiKey
    ) {
        parent::__construct();
        $this->username = $username;
        $this->plainPassword = $plainPassword;
        $this->roles = $roles;
        $this->enabled = $enabled;
        $this->email = $email;
        $this->apiKey = $apiKey;
    }

    /**
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

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }
}
