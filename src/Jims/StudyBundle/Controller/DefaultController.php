<?php

namespace Jims\StudyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($format)
    {
        if ($format == 'json') {
            return new JsonResponse(array('msg'=>'good'));
        }
        return $this->render('JimsStudyBundle:Default:index.html.twig', array('name' => ''));
    }
}
