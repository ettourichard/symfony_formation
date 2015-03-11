<?php

namespace Esgi\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
	public function findById($id)
	{
			return $this->createQueryBuilder('c')
				->where('c.id', $id)
				->orderBy('c.name', 'DESC')
				->getQuery()
				->getResult();
	}
}