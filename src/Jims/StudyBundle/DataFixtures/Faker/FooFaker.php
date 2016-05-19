<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/5/15
 * Time: 17:05
 */

namespace Jims\StudyBundle\DataFixtures\Faker;

use Faker\Provider\Base as BaseProvider;

class FooFaker extends BaseProvider
{
  public function nothing()
  {
    return 'nothing';
  }

}