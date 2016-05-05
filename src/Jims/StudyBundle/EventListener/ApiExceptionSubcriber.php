<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/5/8
 * Time: 14:17
 */

namespace Jims\StudyBundle\EventListener;


use Jims\StudyBundle\Api\ApiProblem;
use Jims\StudyBundle\Api\ApiProblemException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiExceptionSubcriber implements EventSubscriberInterface
{
  /**
   * @var
   */
  private $debug;

  public function __construct($debug)
  {
    $this->debug = $debug;
  }
  public function onKernelException(GetResponseForExceptionEvent $event)
  {
    $e = $event->getException();
    $statusCode = $e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500;

    if ($statusCode==500 && $this->debug) {
        return;
    }

    if ($e instanceof ApiProblemException ) {
      $apiProblem = $e->getApiProblem();
    } else {

      //dump($event->getRequest()->getPathInfo());die();

      if( strpos( $event->getRequest()->getPathInfo(), '/api' ) === 0 ){ //只针对 api



        $apiProblem = new ApiProblem($statusCode);

        /*
         * If it's an HttpException message (e.g. for 404, 403),
         * we'll say as a rule that the exception message is safe
         * for the client. Otherwise, it could be some sensitive
         * low-level exception, which should *not* be exposed
         */
        if ($e instanceof HttpExceptionInterface) {
          $apiProblem->set('detail', $e->getMessage());
        }

      } else {
        return ;
      }



    }

    $data = $apiProblem->toArray();
    if ($data['type'] != 'about:blank') {
      $data['type'] = 'http://localhost:8000/docs/errors#'.$data['type'];
    }

    $response = new JsonResponse($data, $apiProblem->getStatusCode());
    $response->headers->set('Content-Type', 'application/problem+json');


    $event->setResponse($response); //重新设置 response



  }


  public static function getSubscribedEvents()
  {
    return array(
      KernelEvents::EXCEPTION => 'onKernelException',
    );

  }

}