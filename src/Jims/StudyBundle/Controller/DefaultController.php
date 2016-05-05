<?php

namespace Jims\StudyBundle\Controller;

use Jims\StudyBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class DefaultController extends Controller
{
    public function indexAction($format)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('JimsStudyBundle:Article')->findOneBy(['id' => 2]);

        //$article = new Article();
        //$article->setTitle('xxxx');
        //$article->setContent('ggggg');

        //$serializer = $this->get('serializer');
        //$serializer->

        $normalize = new GetSetMethodNormalizer();
        $normalize->setCircularReferenceLimit(4);
        $encoder = new JsonEncode();

        $serializer = new Serializer([$normalize], [$encoder]);


        //dump($serializer->serialize($article, 'json'));die();
        dump($serializer->normalize($article));die();



        if ($format == 'json') {
            return new JsonResponse(array('msg'=>'good'));
        }
        return $this->render('JimsStudyBundle:Default:index.html.twig', array('name' => ''));
    }
}
