<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2015/11/15
 * Time: 17:59
 */

namespace Jims\PeteBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Jims\PeteBundle\Entity\User;

class SearchIndexer
{
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        // perhaps you only want to act on some "Product" entity
        if ($entity instanceof User) {
            // ... do something with the Product
        }
    }

}