<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/3/31
 * Time: 16:42
 */

namespace Jims\UiopBundle\EventListener;


use Jims\UiopBundle\Controller\MyTokenCheckInterface;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class PrePostListener
{
  private $token;

  /**
   * PrePostListener constructor.
   */
  public function __construct($token)
  {
    $this->token = $token;
  }

  public function preController(FilterControllerEvent $event)
  {
    //dump($event);
    $controller = $event->getController();
    if (!is_array($controller)) {
        return;
    }

    if ($controller[0] instanceof MyTokenCheckInterface) {
        $token = $event->getRequest()->query->get('token');

        if ($token != $this->token) {
            throw new AccessDeniedException('This action needs a valid token!');
        }

        $event->getRequest()->query->set('auth_key', 'gogogogo');
        $event->getRequest()->attributes->set('auth_key', 'gggg-go'); // my_key
    }


  }

  public function postController(FilterResponseEvent $event)
  {
    //dump($event);
    $my_key =  $event->getRequest()->attributes->get('auth_key');
    if ($my_key) {
        return;
    }

    $response = $event->getResponse();

    $hash = sha1($response->getContent().$my_key);
    $response->headers->set('X-my-oh', $hash);

  }
}