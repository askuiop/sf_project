<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/5/6
 * Time: 16:58
 */

namespace Jims\StudyBundle\Tests\Controller\Api;


use Jims\StudyBundle\Tests\ApiTestCase;

class ArticleControllerTest extends ApiTestCase
{
  protected function setUp()
  {
    parent::setUp();
    $this->createUser('jims');
  }
  public function testGet()
  {
    $this->createArticle(array(
      'content' => 'test'
    ));

    $response = $this->client->get('api/article');

    //print_r($response->getStatusCode()) ; //can not use here!

    //$this->printLastRequestUrl();

    $this->assertEquals(200, $response->getStatusCode());
    //$this->assertContains('get', $response->getBody());

    $this->asserter()->assertResponsePropertyCount($response, 'data' , 1);
    $this->asserter()->assertResponsePropertyIsArray($response, 'data');
    $this->asserter()->assertResponsePropertyEquals($response, 'data[0].content', 'test');
  }

  public function testPut()
  {
    $this->createArticle(array(
      'content' => 'test my good'
    ));

    $data = array(
      'title'  => 'test!',
      'content' => 'test you good too!'
    );

    $response = $this->client->put('api/article/test_title', array(
      'body' => json_encode($data),
    ));

    $this->assertEquals(200, $response->getStatusCode());

    $this->asserter()->assertResponsePropertyEquals($response, 'title' , 'test_title');
  }

  public function testPatch()
  {
    $this->createArticle(array(
      'content' => 'test my good'
    ));

    $data = array(
      'content' => 'patch'
    );

    $response = $this->client->patch('api/article/test_title', array(
      'body' => json_encode($data),
    ));

    $this->assertEquals(200, $response->getStatusCode());

    $this->asserter()->assertResponsePropertyEquals($response, 'content' , 'patch');
    $this->asserter()->assertResponsePropertyEquals($response, 'title' , 'test_title');
  }


  public function testValidationErrors()
  {
    $data = array(
      'content' => 'I\'m from a test!'
    );
    // 1) Create a programmer resource
    $response = $this->client->post('/api/article', [
      'body' => json_encode($data)
    ]);
    $this->assertEquals(400, $response->getStatusCode());
    $this->asserter()->assertResponsePropertiesExist($response, array(
      'type',
      'title',
      'errors',
    ));
    $this->asserter()->assertResponsePropertyExists($response, 'errors.title');
    $this->asserter()->assertResponsePropertyEquals($response, 'errors.title[0]', "plase enter a title!");
    $this->asserter()->assertResponsePropertyDoesNotExist($response, 'errors.content');

    $this->assertEquals('application/problem+json', $response->getHeader('Content-Type'));
  }

  public function testInvaildJson()
  {
    $data = <<<EOF
{
  'title' = 'sldfl
}
EOF;

    // 1) Create a programmer resource
    $response = $this->client->post('/api/article', [
      'body' => $data
    ]);

    $this->debugResponse($response);

    $this->assertEquals(400, $response->getStatusCode());
    $this->asserter()->assertResponsePropertyEquals($response, 'type', 'invalid_body_format');

  }

  public function test404Exception()
  {

    // 1) Create a programmer resource
    $response = $this->client->put('/api/article/xxx');

    $this->debugResponse($response);

    $this->assertEquals(404, $response->getStatusCode());


    $this->assertEquals('application/problem+json', $response->getHeader('Content-Type'));
    $this->asserter()->assertResponsePropertyEquals($response, 'type', 'about:blank');
    $this->asserter()->assertResponsePropertyEquals($response, 'title', 'Not Found');

    $this->asserter()->assertResponsePropertyEquals($response, 'detail', 'No Article found with title "xxx"');

  }


  public function testPagination()
  {
    for ($i=0; $i<25; $i++ ) {
      $this->createArticle(array(
        'title' => 'test_'.$i ,
        'content' => 'test_content'
      ));
    }


    $response = $this->client->get('api/list');

    //page 1
    $this->assertEquals(200, $response->getStatusCode());

    $this->asserter()->assertResponsePropertyEquals(
      $response,
      'items[5].title',
      'test_5'
    );
    $this->asserter()->assertResponsePropertyEquals($response, 'count', 10);
    $this->asserter()->assertResponsePropertyEquals($response, 'total', 25);
    $this->asserter()->assertResponsePropertyExists($response, '_links.next');

    // page 2
    $nextLink = $this->asserter()->readResponseProperty($response, '_links.next');
    $response = $this->client->get($nextLink);
    $this->assertEquals(200, $response->getStatusCode());
    $this->asserter()->assertResponsePropertyEquals(
      $response,
      'items[5].title',
      'test_15'
    );
    $this->asserter()->assertResponsePropertyEquals($response, 'count', 10);

    //last page
    $lastLink = $this->asserter()->readResponseProperty($response, '_links.last');
    $response = $this->client->get($lastLink);
    $this->assertEquals(200, $response->getStatusCode());
    $this->asserter()->assertResponsePropertyEquals(
      $response,
      'items[4].title',
      'test_24'
    );
    $this->asserter()->assertResponsePropertyDoesNotExist($response, 'items[5].name');
    $this->asserter()->assertResponsePropertyEquals($response, 'count', 5);

  }

}