<?php

namespace AppBundle\Repository;

class GradeRepository extends \Doctrine\ORM\EntityRepository
{
    public function getStudentGrades(int $userId): array
    {
        return $this->_em->createQuery("SELECT g, a, su
            FROM AppBundle\Entity\Grade g
            JOIN g.student st
            JOIN g.assignment a
            JOIN a.subject su
            JOIN st.user u
            WHERE u.id = :userId
            ORDER BY a.deadline
            ")->setParameter('userId', $userId)->getResult();
    }
}
