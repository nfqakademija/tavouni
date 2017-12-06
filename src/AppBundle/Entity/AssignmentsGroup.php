<?php
/**
 * Created by PhpStorm.
 * User: aurimas
 * Date: 17.12.6
 * Time: 15.12
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\Collection;

class AssignmentsGroup
{
    private $assignments;
    private $date;

    /**
     * AssignmentGroup constructor.
     * @param $assignments
     * @param $date
     */
    public function __construct(Collection $assignments, \DateTime $date)
    {
        $this->assignments = $assignments;
        $this->date = $date;
    }

    /**
     * @return Collection
     */
    public function getAssignments()
    {
        return $this->assignments;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}