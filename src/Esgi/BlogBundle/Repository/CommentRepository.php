<?php

namespace Esgi\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository
{
    public function findByPost($id)
    {
        return $this->createQueryBuilder('c')
            ->where('c.post_id = :post_id')
            ->orderBy('p.createdAt', 'DESC')
            ->setParameter('post_id', $id)
            ->getQuery()
            ->getResult();
    }
}
