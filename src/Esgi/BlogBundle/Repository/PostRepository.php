<?php

namespace Esgi\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    public function findPublicationStatus($status = true)
    {
        return $this->createQueryBuilder('p')
            ->where('p.isPublished = :is_published')
            ->orderBy('p.createdAt', 'DESC')
            ->setParameter('is_published', $status)
            ->getQuery()
            ->getResult();
    }

    public function findLikeText($text)
    {
        return $this->createQueryBuilder('p')
            ->where('p.title LIKE :text')
            ->orWhere('p.body LIKE :text')
            ->orderBy('p.createdAt', 'DESC')
            ->setParameter('text', '%'.$text.'%')
            ->getQuery()
            ->getResult();
    }
}
