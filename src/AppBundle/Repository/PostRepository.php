<?php

namespace AppBundle\Repository;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends \Doctrine\ORM\EntityRepository
{
    public function getPostsByLecturer($id)
    {
        return $this->_em->createQuery("SELECT p
            FROM AppBundle\Entity\Post p
            JOIN p.author l
            JOIN l.user u
            WHERE u.id = :id
            ORDER BY p.publishedAt DESC
            ")->setParameter('id', $id)->getResult();
    }

    public function getPostsForStudent($id)
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
            WHERE u.id = :id
            GROUP BY p, a, l, g, st, u, se
            ORDER BY seen ASC, p.publishedAt DESC
            ")->setParameter('id', $id)->getResult();
    }
}
