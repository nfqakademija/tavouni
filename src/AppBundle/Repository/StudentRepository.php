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
        return $this->_em->createQuery("SELECT st, a, g,  gr, l
            FROM AppBundle\Entity\Student st
            JOIN st.grades g
            JOIN g.assignment a
            JOIN st.groups gr
            JOIN gr.lectures l
            JOIN l.subject sl
            JOIN a.subject sa
            WHERE l.id = :lectureId AND a.lectureType = l.lectureType AND sl.id = sa.id
            ")->setParameter('lectureId', $lectureId)->getResult();
    }
}
