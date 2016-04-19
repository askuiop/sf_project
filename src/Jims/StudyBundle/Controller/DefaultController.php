<?php

namespace Jims\StudyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('JimsStudyBundle:Default:index.html.twig', array('name' => $name));
    }
}
