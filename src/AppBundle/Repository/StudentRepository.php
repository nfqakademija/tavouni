<?php

namespace AppBundle\Repository;

class StudentRepository extends \Doctrine\ORM\EntityRepository
{
    public function getSubjectStudents(int $subjectId): array
    {
        return $this->_em->createQuery("SELECT st
            FROM AppBundle\Entity\Student st
            JOIN st.groups g
            JOIN g.lectures l
            JOIN l.subject su
            where su.id = :subjectId
            ")->setParameter('subjectId', $subjectId)->getResult();
    }

    public function getStudentsWithGradesByLecture(int $lectureId): array
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
