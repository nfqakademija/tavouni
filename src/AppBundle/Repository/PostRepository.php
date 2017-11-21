<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Lecturer;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends \Doctrine\ORM\EntityRepository
{
    public function getPostsByLecturer(Lecturer $lecturer)
    {
        return $this->_em->createQuery("SELECT p, l
            FROM AppBundle\Entity\Post p
            JOIN p.author l
            WHERE l.id = :id
            ")->setParameter('id', $lecturer->getId())->getResult();
    }

    public function getPostsForStudent($id) {
        return $this->_em->createQuery("SELECT p
            FROM AppBundle\Entity\Post p
            JOIN p.author a
            JOIN p.subject su
            JOIN su.lectures l
            JOIN l.group g
            JOIN g.students st
            JOIN st.user u
            WHERE u.id = :id
            ORDER BY p.publishedAt DESC
            ")->setParameter('id', $id)->getResult();
    }
}
