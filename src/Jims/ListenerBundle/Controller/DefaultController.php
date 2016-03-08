<?php

namespace Jims\ListenerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('JimsListenerBundle:Default:index.html.twig', array('name' => $name));
    }
}
