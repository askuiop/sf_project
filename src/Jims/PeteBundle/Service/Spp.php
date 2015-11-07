<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2015/10/25
 * Time: 12:21
 */

namespace Jims\PeteBundle\Service;

use Jims\PeteBundle\Service\Sgogo;


class Spp
{
    public $one;
    public function __construct(Sgogo $sgogo)
    {
        $this->one = $sgogo;
        echo 'xxxxxx';
    }

    public function say()
    {
        $this->one->test();
    }
    public function yes()
    {
        echo 'yese!!!!';
    }
}