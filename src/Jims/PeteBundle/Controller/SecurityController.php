<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2015/10/30
 * Time: 14:12
 */
namespace Jims\PeteBundle\Controller;

use Jims\PeteBundle\Entity\Ugroup;
use Jims\PeteBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Snc\RedisBundle\Doctrine\Cache\RedisCache;
use Predis\Client;

class SecurityController extends BaseController
{
    /**
     * @Route("/admin")
     */
    public function adminAciton()
    {
        # init predis client
        $predis = new RedisCache();
        $predis->setRedis(new Client());
        # define cache lifetime period as 1 hour in seconds
        $cache_lifetime = 0;

        /*
        $rlt =  $this->getDoctrine()->getManager()
            ->createQuery('SELECT c FROM JimsPeteBundle:User c')
            ->setMaxResults(100)
            # pass predis object as driver
            ->setResultCacheDriver($predis)
            # set cache lifetime
            ->setResultCacheLifetime($cache_lifetime)
            ->getResult();
        */


        $rlt =  $this->getDoctrine()->getManager()
            ->getRepository("JimsPeteBundle:User")
            ->find(1)->setResultCacheDriver($predis)->setResultCacheLifetime($cache_lifetime);
        dump($rlt);


        return new Response('<html><body>Admin page!lalala</body></html>');
    }
    /**
     * @Route("/admin/users")
     */
    public function adminUsersAciton()
    {
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN', null, 'Unable to access this page!');
        return new Response('<html><body>Admin users!yoyoyo</body></html>');
    }

    /**
     * @Route("/login", name="security_login_form")
     */
    public function loginAction()
    {
        //$predis = new RedisCache();
        //$predis->setRedis(new Client());

        $helper = $this->get('security.authentication_utils');

        return $this->render('JimsPeteBundle:security:login.html.twig', array(
            // last username entered by the user (if any)
            'last_username' => $helper->getLastUsername(),
            // last authentication error (if any)
            'error' => $helper->getLastAuthenticationError(),
        ));
    }


    /**
     * This is the route the login form submits to.
     *
     * But, this will never be executed. Symfony will intercept this first
     * and handle the login automatically. See form_login in app/config/security.yml
     *
     * @Route("/logincheck", name="security_login_check")
     */
    public function logincheckAction()
    {
        throw new \Exception('This should never be reached!');
    }
    /**
     * This is the route the user can use to logout.
     *
     * But, this will never be executed. Symfony will intercept this first
     * and handle the logout automatically. See logout in app/config/security.yml
     *
     * @Route("/logout", name="security_logout")
     */
    public function logoutAction()
    {
        throw new \Exception('This should never be reached!');
    }

}