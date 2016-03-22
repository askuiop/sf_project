<?php

namespace Jims\UiopBundle\Controller;

use Jims\UiopBundle\Form\UserLoginType;
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
        return $this->render('JimsUiopBundle:Default:login.html.twig', array(
            //'form' => $formView,
            'error' => $helper->getLastAuthenticationError(),
        ));
    }

    /**
     * This is the route the login form submits to.
     *
     * But, this will never be executed. Symfony will intercept this first
     * and handle the login automatically. See form_login in app/config/security.yml
     */
    public function logincheckAction()
    {
        throw new \Exception('This should never be reached!2222');
    }
    /**
     * This is the route the user can use to logout.
     *
     * But, this will never be executed. Symfony will intercept this first
     * and handle the logout automatically. See logout in app/config/security.yml
     */
    public function logoutAction()
    {
        throw new \Exception('This should never be reached!222');
    }
}
