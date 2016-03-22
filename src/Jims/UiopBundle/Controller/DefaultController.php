<?php

namespace Jims\UiopBundle\Controller;

use Jims\PeteBundle\Entity\GBook;
use Jims\PeteBundle\Entity\Ugroup;
use Jims\PeteBundle\Entity\User;
use Jims\UiopBundle\Form\GbookType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {

        //echo  $this->get('session')->getFlashBag()->;

        echo $this->get('quote')->go();

        $em = $this->getDoctrine()->getManager();
        $criteria = [
            'categoryId'=>1,
        ];
        $rlt = $em->getRepository("JimsPeteBundle:Post")->findby($criteria);

        //dump($rlt);

        /**
         * @var $user User
         */
        $user = $em->getRepository("JimsPeteBundle:User")->findBy(array('id'=>15));
        dump($user[0]->getUgroups());
        //dump($user);

        /**
         * @var $group Ugroup
         */
        $group = $em->getRepository("JimsPeteBundle:Ugroup")->findBy(array('id'=>1));

        dump($group[0]->getUsers()->toArray());

        return $this->render('JimsUiopBundle:Default:index.html.twig', array('rlt' => $rlt));
    }

    public function postDetailAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('JimsPeteBundle:Post')->find($id);
        dump($post->getTags());

        //评论
        $gbList = $em->getRepository('JimsPeteBundle:GBook')->findBy(array(
            'id'=>$post->getId(),
        ));

        //print_r($request->getClientIp());
        //print_r($request->getClientIps());
        //print_r($request->getRequestUri());
        //print_r($request->getRealMethod());
        //print_r($request->getSession()->get('PHPSESSID'));
        //print_r($request->cookies->get('PHPSESSID'));


        $gb = new GBook();
        $form = $this->createForm(new GbookType(), $gb);

        $form->handleRequest($request);
        if( $form->isValid() && $form->isSubmitted() ){

            //print_r($request->request->get('jims_uiop_bundle_gbook_type'));

            $gb->setName('匿名');
            //dump($this->getUser());
            //exit;
            $user = $em->getRepository('JimsPeteBundle:User')->findOneBy(array(
                'id' => $this->getUser()->getId(),
            ));
            $gb->setUser($user);
            $gb->setPost($post);
            //$gb->setUpdatedAt(new \DateTime());
            //$gb->setCreatedAt(new \DateTime());
            $em->persist($gb);
            $em->flush();


            $this->addFlash('success', 'good');
            //return $this->redirectToRoute('JimsUiop_homepage');
        }




        return $this->render('JimsUiopBundle:Default:post_detail.html.twig',
          array(
            'gbList' => $gbList,
            'post'=> $post,
            'form' => $form->createView(),
        ));



        //echo $this->getRequest()->attributes->get('_controller');


    }
}
