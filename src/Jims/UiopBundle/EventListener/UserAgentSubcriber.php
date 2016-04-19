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

  public function onKernelRequest(KernelEvent $event)
  {
    //dump($event);
    //$request = $event->getRequest();
    //$userAgent = $request->headers->get('User-Agent');
    //$this->logger->info('Hello there browser: '.$userAgent);

    //dump($this->requestStack->getCurrentRequest());
    //dump($event->getRequest());
  }

  public function onKernelController(FilterControllerEvent $event)
  {
    //dump($event);
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