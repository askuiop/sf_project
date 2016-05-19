<?php

namespace Jims\StudyBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{
  public function findAllQueryBuilder($filter = '')
  {
    $qb =  $this->createQueryBuilder('Article');

    if ($filter) {
        $qb->andWhere('Article.title LIKE :filter OR Article.content LIKE :filter')
          ->setParameter('filter', '%'.$filter.'%');
    }
    return $qb;
  }
}
