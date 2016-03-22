<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/3/20
 * Time: 11:38
 */

namespace Jims\UiopBundle\Service;


use Symfony\Component\HttpKernel\Log\LoggerInterface;

class Quote
{
  private $loger;
  /**
   * Quote constructor.
   */
  public function __construct(LoggerInterface $loger)
  {
    $this->loger = $loger;
  }

  public function go()
    {
      $this->loger->warn('xxx');
      return 'gogogo!!!!!!';
    }
}