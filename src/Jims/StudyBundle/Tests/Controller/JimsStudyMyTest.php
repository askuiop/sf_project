<?php

namespace Jims\StudyBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JimsStudyMyTest extends WebTestCase
{
  public function testIndex()
  {
    $client = static::createClient();

    $crawler = $client->request('GET', '/');

    $this->assertTrue($crawler->filter('html:contains("symfony")')->count() > 0);
  }
}
