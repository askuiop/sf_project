<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/5/10
 * Time: 13:00
 */

namespace Jims\StudyBundle\Pagination;


use Symfony\Component\Routing\RouterInterface;
use Jims\StudyBundle\Pagination\PaginatedCollection;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Request;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

class PaginationFactory
{
  /**
   * @var RouterInterface
   */
  private $router;

  public function __construct(RouterInterface $router)
  {

    $this->router = $router;
  }
  public function createCollection(QueryBuilder $qb, Request $request, $route, array $routeParams = array())
  {
    $page = $request->query->get('page', 1);
    $adapter = new DoctrineORMAdapter($qb);
    $pagerfanta = new Pagerfanta($adapter);
    $pagerfanta->setMaxPerPage(10);
    $pagerfanta->setCurrentPage($page);
    $programmers = [];
    foreach ($pagerfanta->getCurrentPageResults() as $result) {
      $programmers[] = $result;
    }
    $paginatedCollection = new PaginatedCollection($programmers, $pagerfanta->getNbResults());

    $routeParams = array_merge($routeParams, $request->query->all());

    $createLinkUrl = function($targetPage) use ($route, $routeParams) {
      return $this->router->generate($route, array_merge(
        $routeParams,
        array('page' => $targetPage)
      ));
    };
    $paginatedCollection->addLink('self', $createLinkUrl($page));
    $paginatedCollection->addLink('first', $createLinkUrl(1));
    $paginatedCollection->addLink('last', $createLinkUrl($pagerfanta->getNbPages()));
    if ($pagerfanta->hasNextPage()) {
      $paginatedCollection->addLink('next', $createLinkUrl($pagerfanta->getNextPage()));
    }
    if ($pagerfanta->hasPreviousPage()) {
      $paginatedCollection->addLink('prev', $createLinkUrl($pagerfanta->getPreviousPage()));
    }
    return $paginatedCollection;
  }

}