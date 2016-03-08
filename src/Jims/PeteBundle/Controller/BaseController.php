<?php

namespace Jims\PeteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    public function fuckyou()
    {
        return 'fuch you!';
    }
    /**
     * @Route("/stest")
     * @Template("")
     */
    public function sssAction()
    {
        $service_test = $this->get('jims_pete.spp');
        $service_test->say();
        return new Response('<br>done!');
    }
}