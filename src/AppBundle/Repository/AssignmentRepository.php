<?php

namespace AppBundle\Repository;

class AssignmentRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAssignmentsByStudent(int $userId): array
    {
        return $this->_em->createQuery("SELECT a, s, l, g, st
            FROM AppBundle\Entity\Assignment a
            JOIN a.subject s
            JOIN s.lectures l 
            JOIN l.group g
            JOIN g.students st
            JOIN st.user u
            WHERE u.id = :id
            ORDER BY a.deadline")->setParameter('id', $userId)->getResult();
    }

    public function getAssignmentsGradesAverageByStudentGroup(int $userId): array
    {
        return $this->_em->createQuery("SELECT a1, su, AVG(g1.value)
            FROM AppBundle\Entity\Assignment a1
            JOIN a1.grades g1
            JOIN a1.subject su
            WHERE a1 IN ( 
              SELECT a2
              FROM AppBundle\Entity\Assignment a2
              JOIN a2.grades g2
              JOIN g2.student st
              JOIN st.user u
              WHERE u.id = :userId)
            GROUP BY a1
          ")->setParameter('userId', $userId)->getResult();
    }
    
    public function getSubjectAssignments(int $subjectId): array
    {
        return $this->_em->createQuery("SELECT a
            FROM AppBundle\Entity\Assignment a
            JOIN a.subject s
            WHERE s.id = :subjectId
            ORDER BY a.deadline")->setParameter('subjectId', $subjectId)->getResult();
    }
}
