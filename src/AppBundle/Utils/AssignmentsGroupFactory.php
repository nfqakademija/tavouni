<?php

namespace AppBundle\Utils;

use AppBundle\ValueObject\AssignmentsGroup;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class AssignmentsGroupFactory
{
    public function createAssignmentsGroupCollection(array $assignments): Collection
    {
        $assignmentsGroups = new ArrayCollection();
        $assignmentsCount = count($assignments);
        for ($i = 0; $i < $assignmentsCount;) {
            $date = $assignments[$i]->getDeadline();
            $assignmentsByDate = new ArrayCollection();
            for ($j = $i; $j < $assignmentsCount && $assignments[$j]->getDeadline() == $date; $j++) {
                $assignmentsByDate[] = $assignments[$j];
            }
            $assignmentsGroups->add(new AssignmentsGroup($assignmentsByDate, $date));
            $i = $j;
        }

        return $assignmentsGroups;
    }
}
