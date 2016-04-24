<?php

namespace Jims\StudyBundle\Controller;

use Jims\StudyBundle\Entity\StUser;
use Jims\StudyBundle\Form\StUserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    public function loginAction()
    {
        //$form = $this->createForm(new UserLoginType(), null, array(
        //    'action'=>$this->generateUrl('JimsUiop_login_check'),
        //));

        $helper = $this->get('security.authentication_utils');

        //$form = new UserLoginType();
        //$formView = $form->createView();
        return $this->render('JimsStudyBundle:Security:login.html.twig', array(
            //'form' => $formView,
          'error' => $helper->getLastAuthenticationError(),
        ));
    }

    public function registerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new StUserType(), null , array(
            'action' => ''
        ));
        $form->handleRequest($request);

        dump($form->get('username')->getErrors());

        if ($form->isValid()) {

            //dump($form->get('plainPassword')->getErrors());
            //$form->get('username')->addError(new FormError('xxxxx'));

            $st_user = $form->getData();
            //dump($data['username']);
            //die('xxx');
            $st_user->setRoles(array("ROLE_USER"));
//
            $em->persist($st_user);
            $em->flush();

            $this->addFlash('msg', 'success!');
            return $this->redirectToRoute('jims_study_homepage');


        }else {

        }



        return $this->render('JimsStudyBundle:Security:register.html.twig', array(
            'form' => $form->createView(),
        ) );
    }

    public function logincheckAction()
    {
        throw new \Exception('This should never be reached!check');
    }

    public function logoutAction()
    {
        throw new \Exception('This should never be reached!logout');
    }
}
