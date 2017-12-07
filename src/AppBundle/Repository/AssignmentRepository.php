<?php

namespace AppBundle\Repository;

/**
 * AssignmentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AssignmentRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAssignmentsByStudent($id)
    {
        return $this->_em->createQuery("SELECT a, s, l, g, st
            FROM AppBundle\Entity\Assignment a
            JOIN a.subject s
            JOIN s.lectures l 
            JOIN l.group g
            JOIN g.students st
            JOIN st.user u
            WHERE u.id = :id
            ORDER BY a.deadline")->setParameter('id', $id)->getResult();
    }
    public function getAssignmentsGradesAverageByStudentGroup($id)
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
              WHERE u.id = :id)
            GROUP BY a1
          ")->setParameter('id', $id)->getResult();
    }
    
    public function getSubjectAssignments($id)
    {
        return $this->_em->createQuery("SELECT a
            FROM AppBundle\Entity\Assignment a
            JOIN a.subject s
            WHERE s.id = :id
            ORDER BY a.deadline")->setParameter('id', $id)->getResult();
    }
}
