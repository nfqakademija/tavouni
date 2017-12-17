<?php

namespace AppBundle\Repository;

class AssignmentEventRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAssignmentEventsForStudent(int $userId): array
    {
        return $this->_em->createQuery("SELECT ae
            FROM AppBundle\Entity\AssignmentEvent ae
            JOIN ae.assignment a
            JOIN a.subject su
            JOIN su.lectures l
            JOIN l.group g
            JOIN g.students st
            JOIN st.user u
            WHERE u.id = :userId
            ")->setParameter('userId', $userId)->getResult();
    }

    public function getAssignmentEventsForLecturer(int $userId): array
    {
        return $this->_em->createQuery("SELECT ae
            FROM AppBundle\Entity\AssignmentEvent ae
            JOIN ae.assignment a
            JOIN a.subject su
            JOIN su.coordinator c
            JOIN c.user u
            WHERE u.id = :userId
            ")->setParameter('userId', $userId)->getResult();
    }
}
