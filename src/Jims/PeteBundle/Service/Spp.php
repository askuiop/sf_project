<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2015/10/25
 * Time: 12:21
 */

namespace Jims\PeteBundle\Service;

use Jims\PeteBundle\Service\Sgogo;
use Symfony\Component\HttpFoundation\RequestStack;


class Spp
{
    public $one;
    public $param;
    public $ary;
    protected $requestStack;
    public function __construct(Sgogo $sgogo=null, RequestStack $requestStack, $param, $ary, $return)
    {
        $this->one = $sgogo;
        $this->requestStack = $requestStack;

        echo 'xxxxxx';
        $this->param = $param;
        dump($ary);
        dump($return);
    }

    public function say()
    {
        $this->one->test();
        echo '<br>this param is :'.$this->param;
        echo '<br>this ary is :'.$this->ary[0];

        dump($this->requestStack);
        $request = $this->requestStack->getCurrentRequest();
        $page = $request->query->get('page', 1);
        echo '<br>page:'.$page;
    }
    public function yes()
    {
        echo 'yese!!!!';
    }

    public function setAry($ary)
    {
        $this->ary = $ary;
    }
}