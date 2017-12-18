<?php

namespace AppBundle\ValueObject;

use Doctrine\Common\Collections\Collection;

class AssignmentsGroup
{
    /**
     * @var Collection
     */
    private $assignments;

    /**
     * @var \DateTime
     */
    private $date;

    /**
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
    public function getAssignments(): Collection
    {
        return $this->assignments;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }
}
