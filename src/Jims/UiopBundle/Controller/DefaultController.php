<?php

namespace Jims\UiopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('JimsUiopBundle:Default:index.html.twig', array('name' => $name));
    }
}
