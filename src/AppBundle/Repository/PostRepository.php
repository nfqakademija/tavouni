<?php

namespace AppBundle\Repository;

class PostRepository extends \Doctrine\ORM\EntityRepository
{
    public function getLecturePosts(int $lectureId)
    {
        return $this->_em->createQuery("SELECT p
            FROM AppBundle\Entity\Post p
            JOIN p.lecture l
            WHERE l.id = :lectureId
            ORDER BY p.publishedAt DESC
            ")->setParameter('lectureId', $lectureId)->getResult();
    }

    public function getPostsForStudent(int $userId)
    {
        return $this->_em->createQuery("SELECT p, a, l, g, st, u, se, 
            CASE WHEN (st MEMBER OF p.seenByStudents) THEN 1 ELSE 0 END AS HIDDEN seen
            FROM AppBundle\Entity\Post p
            JOIN p.author a
            JOIN p.lecture l
            JOIN l.group g
            JOIN g.students st
            JOIN st.user u
            LEFT JOIN p.seenByStudents se
            WHERE u.id = :userId
            GROUP BY p, a, l, g, st, u, se
            ORDER BY seen ASC, p.publishedAt DESC
            ")->setParameter('userId', $userId)->getResult();
    }
}
