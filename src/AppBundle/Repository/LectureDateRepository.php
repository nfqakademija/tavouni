<?php

namespace AppBundle\Repository;

class LectureDateRepository extends \Doctrine\ORM\EntityRepository
{
    public function getLectureDatesByStudent(int $userId): array
    {
        return $this->_em->createQuery("SELECT ld, l, su, r, b, lr
            FROM AppBundle\Entity\LectureDate ld
            JOIN ld.lecture l
            JOIN l.group g
            JOIN g.students st
            JOIN st.user u
            JOIN l.subject su
            JOIN l.room r
            JOIN r.building b
            JOIN l.lecturer lr
            WHERE u.id = :userId
            ")->setParameter('userId', $userId)->getResult();
    }

    public function getLectureDatesByLecturer(int $userId): array
    {
        return $this->_em->createQuery("SELECT ld, l, su, r, b, lr
            FROM AppBundle\Entity\LectureDate ld
            JOIN ld.lecture l
            JOIN l.group g
            JOIN l.subject su
            JOIN l.room r
            JOIN r.building b
            JOIN l.lecturer lr
            JOIN lr.user u
            WHERE u.id = :userId
            ")->setParameter('userId', $userId)->getResult();
    }
}
