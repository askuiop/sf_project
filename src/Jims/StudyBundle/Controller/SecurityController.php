<?php

namespace Jims\StudyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

    public function logincheckAction()
    {
        throw new \Exception('This should never be reached!check');
    }

    public function logoutAction()
    {
        throw new \Exception('This should never be reached!logout');
    }
}
