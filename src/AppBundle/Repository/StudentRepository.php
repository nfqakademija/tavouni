<?php

namespace AppBundle\Repository;

/**
 * StudentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StudentRepository extends \Doctrine\ORM\EntityRepository
{
    public function getSubjectStudents($id)
    {
        return $this->_em->createQuery("SELECT st
            FROM AppBundle\Entity\Student st
            JOIN st.groups g
            JOIN g.lectures l
            JOIN l.subject su
            where su.id = :id
            ")->setParameter('id', $id)->getResult();
    }

    public function getStudentsWithGradesByLecture($lectureId)
    {
        return $this->_em->createQuery("SELECT st, a, g,  gr, l, lt, ltl
            FROM AppBundle\Entity\Student st
            JOIN st.grades g
            JOIN g.assignment a
            JOIN st.groups gr
            JOIN gr.lectures l
            JOIN l.subject sl
            JOIN a.subject sa
            JOIN a.lectureType lt
            JOIN l.lectureType ltl
            WHERE l.id = :lectureId AND lt.id = ltl.id AND sl.id = sa.id
            ")->setParameter('lectureId', $lectureId)->getResult();
    }
}
