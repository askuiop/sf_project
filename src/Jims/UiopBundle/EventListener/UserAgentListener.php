<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/3/31
 * Time: 14:03
 */

namespace Jims\UiopBundle\EventListener;


class UserAgentListener
{
  public function sayUserAgent($event)
  {
    //dump($event);
  }
  public function saySelfDesign($event)
  {
    dump($event);

  }

}