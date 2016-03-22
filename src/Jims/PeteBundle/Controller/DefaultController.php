<?php

namespace Jims\PeteBundle\Controller;

use Jims\PeteBundle\Entity\Category;
use Jims\PeteBundle\Form\UserType;
use Jims\PeteBundle\Entity\Ugroup;
use Jims\PeteBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends BaseController
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction(Request $request , $name)
    {
        #$a = $this->getRequest()->get('a');
        #$a = $this->getParameter($name);
        $a = $request->get('a').'<br>';
        $session = $request->getSession();

        #$c = $session->get('c');
        $c = $this->fuckyou();

        /**
         * Service test
         */
        $this->get('jims_pete.spp')->say();


        $this->container->get('doctrine');

        return array('name' => '   fuck you '.$name.$a ,"c"=>$c);
        #return new Response("jims");
        #return new JsonResponse(['name'=>'jims']);
        #return new RedirectResponse('/',301);

        /*
        $html = $this->container->get('templating')->render(
            'lucky/number.html.twig',
            array('luckyNumberList' => $numbersList)
        );
        return new Response($html);
        */

    }

    /**
     * @Route("/user/add")
     * @Template("JimsPeteBundle:pete:add_user.html.twig")
     */
    public function addUserAction(Request $request)
    {

        //$translator = $this->get("translator");
        //dump($translator->trans('title.homepage'));
        //die();


        /*
        $em = $this->getDoctrine()->getManager();

        $user = new \Jims\PeteBundle\Entity\User();
        $user->setUseName("jimspete");
        $user->setAccount("jims");
        $user->setIsAvailable(1);
        $user->setPsw("yaya");
        $user->setCreatedAt(new \DateTime());
        $user->setUpdatedAt(new \DateTime());

        $profile = new \Jims\PeteBundle\Entity\Profile();
        $profile->setIsAvailable(1);
        $profile->setAdress('中国');
        $profile->setRealName("祥帅");
        $profile->setTel("1588888888");
        $profile->setCreatedAt(new \DateTime());
        $profile->setUpdatedAt(new \DateTime());
        $profile->setUser($user);

        $em->persist($user);
        $em->persist($profile);
        $em->flush();

        return new Response("ok!");
        */

        $user = new User();

        $cate1 = new Category();
        $cate1->name = 'cat1';
        $user->getCategory()->add($cate1);
        $cate2 = new Category();
        $cate2->name = 'cat2';
        $user->getCategory()->add($cate2);

        $form = $this->createForm(new UserType(), $user);


        /*
        $form = $this->createFormBuilder($user)
            ->add("useName")
            ->add("account")
            ->add("psw")
            ->add("isAvailable")
            ->add("createdAt")
            ->add("UpdatedAt")
            ->add("save",'submit',array("label"=>"add"))
            ->getForm();*/

        $form->handleRequest($request);
        if ($form->isValid()) {
            $user->setIsAvailable(1);
            $user->setcreatedAt(new \DateTime());
            $user->setUpdatedAt(new \DateTime());
            $user->setPassword(password_hash($form->get("password")->getData(),PASSWORD_DEFAULT));
            $user->setAvatar('');


            $em = $this->getDoctrine()->getManager();

            //$user->upload();

            $em->persist($user);
            $em->flush();
            $msg = '添加成功！';


        } else {
            $msg = '';
        }
        $form_view = $form->createView();
        return array(
            'form' => $form_view,
            'msg' => $msg,
            "name" => "jims",
        );
    }

    /**
     * @Route("/user")
     * @Template("JimsPeteBundle:Default:index.html.twig")
     */
    public function getUserAction()
    {
        $em = $this->getDoctrine();
        $user = $em->getRepository("\Jims\PeteBundle\Entity\User")->find(1);
        /**
         * @var $user \Jims\PeteBundle\Entity\User
         */
        $tel = $user->getUsername();

        return array('name' => '   fuck you ' ,"c"=>$tel);
    }

    /**
     * @Route("/group/add")
     * @Template("JimsPeteBundle:pete:add_group.html.twig")
     */
    public function groupAddAction(Request $request)
    {
        $group = new Ugroup();
        $form = $this->createFormBuilder($group,array(
            'validation_groups' => array('add'),
        ))
            ->add("groupName")
            ->add('save','submit',array("label"=>"增加"))
            ->getForm();

        $form_view = $form->createView();

        $form->handleRequest($request);


        if ($form->isValid()) {
            $group->setIsAvailable(1);
            $group->setCreatedAt(new \DateTime());
            $group->setupdatedAt(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($group);
            $em->flush();
            $msg = '添加成功！';
        } else {

            $msg = '';

            echo 44;
            //echo $form->getErrors();
            foreach($form as $fieldName => $field){
                echo $fieldName.":";

                foreach( $field->getErrors(true) as $error){
                    //print_r($error);
                    //exit;
                    echo $error->getMessage();
                    echo '<br>';
                }
            }
        }


        return array('form'=>$form_view,'msg'=>$msg);
        //$em = $this->getDoctrine()->getManager();

        /*
        $group = new \Jims\PeteBundle\Entity\Ugroup();
        $group->setGroupName("admin");
        $group->setCreatedAt(new \DateTime());
        $group->setUpdatedAt(new \DateTime());
        $group->setIsAvailable(1);

        $user = $em->getRepository("\Jims\PeteBundle\Entity\User")->find(1);

        $group->addUser($user);

        $em->persist($group);
        $em->flush();
        */
        /**
         * @var $group \Jims\PeteBundle\Entity\Ugroup
         * @var $user \Jims\PeteBundle\Entity\User
         */
        /*
        $group = $em->getRepository("\Jims\PeteBundle\Entity\Ugroup")->find(1);
        $user = $em->getRepository("\Jims\PeteBundle\Entity\User")->find(1);

        $group->addUser($user);
        $user->addUgroup($group);

        //$em->persist($group);
        $em->flush();

        return new Response("fine4!");
        */


    }
    /**
     * @Route("/yaya")
     * @Template("JimsPeteBundle:pete:yaya.html.twig")
     */
    public function yayaAction()
    {

        return array('name' => '   fuck you ');
    }
}
