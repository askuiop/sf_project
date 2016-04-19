<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/3/31
 * Time: 14:35
 */

namespace Jims\UiopBundle\EventListener;


use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class MyEventCreater
{
  /**
   * @var EventDispatcher
   */
  private $dispatcher;

  /**
   * MyEventCreater constructor.
   */
  public function __construct(EventDispatcherInterface $dispatcher)
  {
    $this->dispatcher = $dispatcher;


  }

  public function myFirstEvent()
  {
    $fistEvent = new MyEventType();
    $this->dispatcher->dispatch(MyEventType::NAME, new MyEventType());
  }
}