<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/3/31
 * Time: 14:37
 */

namespace Jims\UiopBundle\EventListener;


use Symfony\Component\EventDispatcher\Event;

class MyEventType extends Event
{
  const NAME = 'jims.doing';
  /**
   * @var
   */
  private $data;

  /**
   * MyEventType constructor.
   */
  public function __construct()
  {
    $this->data = [1,2];
  }

  /**
   * @return mixed
   */
  public function getData()
  {
    return $this->data;
  }

}