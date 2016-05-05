<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/3/29
 * Time: 16:57
 */

namespace Jims\UiopBundle\EventListener;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\KernelEvent;

class UserAgentSubcriber implements EventSubscriberInterface
{
  /**
   * @var RequestStack
   */
  private $requestStack;

  /**
   * UserAgentSubcriber constructor.
   */
  public function __construct(RequestStack $requestStack)
  {

    $this->requestStack = $requestStack;
  }

  public static function getSubscribedEvents()
  {
    return array(
      'kernel.request' => 'onKernelRequest',
      'kernel.controller' => 'onKernelController',
      'kernel.response' => 'onKernelResponse',
      'kernel.finish_request' => 'onFinishRequest',
      'kernel.view' => 'onView',
    );
  }

  public function onKernelRequest(GetResponseEvent $event)
  {
    //dump($event);
    //$request = $event->getRequest();
    //$userAgent = $request->headers->get('User-Agent');
    //$this->logger->info('Hello there browser: '.$userAgent);

    //dump($this->requestStack->getCurrentRequest());
    //dump($event->getRequest());


    if (rand(0,100)>50) {
      //$response = new Response();
      //$response->setContent('not lucky!');
      //$event->setResponse($response);
    }

    //dump($event->getRequest()->attributes->has('ss'));die();

    if (!$event->getRequest()->attributes->has('ss')) {
      $event->getRequest()->attributes->set('ss', 'xxxx');

      //$event->getRequest()->attributes->set('_controller', function($ss){
      //  //匿名函数可以获得 传递给 controller 的参数
      //  //dump($ss);die();
      //});
    }




  }

  public function onKernelController(FilterControllerEvent $event)
  {
    //dump($event);die();
  }

  public function onKernelResponse(FilterResponseEvent $event)
  {
    //dump($event);
  }

  public function onFinishRequest($event)
  {
    //dump($event);
  }

  public function onView($event)
  {
    //dump($event);
  }

}