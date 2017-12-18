<?php

namespace AppBundle\Repository;

class LectureRepository extends \Doctrine\ORM\EntityRepository
{
    public function getLecturesForLecturer(int $userId): array
    {
        return $this->_em->createQuery("SELECT l, s, g
            FROM AppBundle\Entity\Lecture l
            JOIN l.lecturer lr
            JOIN l.group g
            JOIN l.subject s
            JOIN lr.user u
            WHERE u.id = :userId
            ")->setParameter('userId', $userId)->getResult();
    }
}
