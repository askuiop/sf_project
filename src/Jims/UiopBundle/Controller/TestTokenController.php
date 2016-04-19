<?php

namespace Jims\UiopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jims\UiopBundle\Controller\MyTokenCheckInterface;

class TestTokenController extends Controller implements MyTokenCheckInterface
{
    public function indexAction()
    {
        return $this->render('JimsUiopBundle:Default:login.html.twig', array('error'=>''));
    }
}
