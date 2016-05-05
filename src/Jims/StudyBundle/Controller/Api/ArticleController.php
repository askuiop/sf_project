<?php

namespace Jims\StudyBundle\Controller\Api;

use Jims\StudyBundle\Api\ApiProblem;
use Jims\StudyBundle\Api\ApiProblemException;
use Jims\StudyBundle\Entity\Article;
use Jims\StudyBundle\Form\ArticleType;
use Jims\StudyBundle\Form\UpdateArticleType;
use Jims\StudyBundle\Pagination\PaginatedCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Form\FormInterface;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

class ArticleController extends Controller
{
    public function listForPaginationAction(Request $request)
    {
        $page = $request->query->get('page', 1);

        $qb = $this->getDoctrine()
          ->getRepository('JimsStudyBundle:Article')
          ->findAllQueryBuilder();

        $adapter = new DoctrineORMAdapter($qb);

        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(10);
        $pagerfanta->setCurrentPage($page);

        //dump($pagerfanta->getCurrentPageResults());die();

        $articles = [];
        foreach ($pagerfanta->getCurrentPageResults() as $result) {
            $articles[] = $result;
        }
        //dump($articles);die();

        $paginatedCollection = new PaginatedCollection($articles, $pagerfanta->getNbResults() );

        $route = 'study_api_article_get_for_pager';
        $routeParams = array();
        $createLinkUrl = function($targetPage) use ($route, $routeParams) {
            return $this->generateUrl($route, array_merge(
              $routeParams,
              array('page' => $targetPage)
            ));
        };

        $paginatedCollection->addLink('self', $createLinkUrl($page));
        $paginatedCollection->addLink('first', $createLinkUrl(1));
        $paginatedCollection->addLink('last', $createLinkUrl($pagerfanta->getNbPages()));
        if ($pagerfanta->hasNextPage()) {
            $paginatedCollection->addLink('next', $createLinkUrl($pagerfanta->getNextPage()));
        }
        if ($pagerfanta->hasPreviousPage()) {
            $paginatedCollection->addLink('prev', $createLinkUrl($pagerfanta->getPreviousPage()));
        }


        $response = $this->createApiResponse($paginatedCollection, 200);

        return $response;

    }
    public function getAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('JimsStudyBundle:Article')->findAll();

        //$serialize = $this->get('serializer');

        //$data = $serialize->normalize($articles, 'json');


        $normalize = new ObjectNormalizer();
        $normalize->setCircularReferenceHandler(function($object){
            return $object->getTitle();
            //return 'xxx';
        });

        $encoder = new JsonEncode();
        $serialize = new Serializer([$normalize], [$encoder]);

        //$data = $serialize->serialize($articles, 'json');
        $data = $serialize->normalize($articles);

        //print_r($data);

        $ret_data = array(
            'status' => 1,
            'data' => $data,
        );




        return new JsonResponse($ret_data, 200);

    }
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $data = $request->getContent();
        $data = json_decode($data, true);

        /*
        $article = new Article();
        $article->setContent($data['content']);
        $article->setTitle($data['title']);
        $article->setCreatedAt(new \DateTime());
        $article->setUpdatedAt(new \DateTime());
        $user = $em->getRepository('JimsStudyBundle:StUser')->findOneBy(['id'=>3]);
        $course = $em->getRepository('JimsStudyBundle:Course')->findOneBy(['id'=>3]);
        $article->setUser($user);
        $article->addCouse($course);
        */

        if (null === $data) {
            $apiProblem = new ApiProblem(400, ApiProblem::TYPE_INVALID_REQUEST_BODY_FORMAT);

            throw new ApiProblemException($apiProblem);

            //throw new HttpException(400, 'Invaild Json');
        }

        $article = new Article();
        $form = $this->createForm(new ArticleType(), $article);
        $form->submit($data);

        if (!$form->isValid()) {
            //header('Content-Type: cli');
            //dump( (string)$form->getErrors(true ,false)) ;die();

            $this->throwApiProblemVaildationException($form);

        }

        //$article->setCreatedAt(new \DateTime());
        //$article->setUpdatedAt(new \DateTime());

        //$user = $em->getRepository('JimsStudyBundle:StUser')->findOneBy(['id'=>3]);
        //$course = $em->getRepository('JimsStudyBundle:Course')->findOneBy(['id'=>3]);

        //$article->setUser($user);
        //$article->addCouse($course);

        $em->persist($article);
        $em->flush();



        return new Response('I am api , I have done it!');
    }

    public function putAction($title, Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('JimsStudyBundle:Article')->findOneBy(['title' => $title]);

        if(!$article){
            throw $this->createNotFoundException(sprintf(
                'No Article found with title "%s"',
              $title
            ));
        }

        ##1 for update
        #$form = $this->createForm(new ArticleType(), $article, array(
        #    'is_edit' => true,
        #));

        ##2 for update
        //$form = $this->createForm(new UpdateArticleType(), $article);


        #for patch test
        $form = $this->createForm(new ArticleType(), $article );


        $data = json_decode($request->getContent(), true);

        #$clearMissing. It's default value - true - means that any missing fields are nullified. But if you set it to false, those fields are ignored. That's perfect PATCH behavior.
        $clearMissing = $request->getMethod() != 'PATCH';
        $form->submit($data, $clearMissing);
        if (!$form->isValid()) {
            //header('Content-Type: cli');
            //dump( (string)$form->getErrors(true ,false)) ;die();

            $this->throwApiProblemVaildationException($form);

        }


        $em->persist($article);
        $em->flush();

        $response = new JsonResponse($this->serializeArticle($article), 200);


        return $response;

    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('JimsStudyBundle:Article')->findOneBy(['id' => $id]);
        if($article){
            $em->remove($article);
            $em->flush();
        }

        return new Response(null, 204);
    }

    private function serializeArticle(Article $article)
    {
        return array(
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
        );
    }


    private function getErrorsFromForm(FormInterface $form)
    {
        $errors = array();
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }
        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getErrorsFromForm($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }
        return $errors;
    }

    private function throwApiProblemVaildationException(FormInterface $form)
    {
        $errors = $this->getErrorsFromForm($form);

        $apiProblem = new ApiProblem(400, ApiProblem::TYPE_VALIDATION_ERROR );
        $apiProblem->set('errors', $errors);


        throw new ApiProblemException($apiProblem);
    }

    private function createApiResponse($data, $statusCode = 200)
    {
        //dump($data);

        $propertyNormalizer = new PropertyNormalizer();

        $callback = function ($dateTime) {
            return $dateTime instanceof \DateTime
              ? $dateTime->format(\DateTime::ISO8601)
              : '';
        };

        $propertyNormalizer->setCallbacks(array('createdAt' => $callback, 'updatedAt'=>$callback));


        $normalize = new ObjectNormalizer();
        $normalize->setCircularReferenceHandler(function($object){
            return $object->getTitle();
        });

        $encoder = new JsonEncode();
        $serialize = new Serializer([$propertyNormalizer], [$encoder]);



        //$json = $serialize->serialize($data, 'json');

        $json = $serialize->serialize($data, 'json');


        //dump($ary);die();
        //dump($json);die();

        return new Response($json, $statusCode, array(
          'Content-Type' => 'application/json'
        ));
    }


}
