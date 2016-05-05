<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/5/9
 * Time: 17:00
 */

namespace Jims\StudyBundle\Pagination;


class PaginatedCollection
{
  private $items;

  private $total;

  private $count;

  private $_links = array();

  /**
   * PaginatedCollection constructor.
   * @param $items
   * @param $total
   * @param $count
   */
  public function __construct($items, $total)
  {
    $this->items = $items;
    $this->total = $total;
    $this->count = count($items);
  }

  public function addLink($ref, $url)
  {
    $this->_links[$ref] = $url;
  }






}