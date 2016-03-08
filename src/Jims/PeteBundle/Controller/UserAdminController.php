<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2015/12/28
 * Time: 9:47
 */

namespace Jims\PeteBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;

class UserAdminController extends CRUDController
{
  public function listAction(){
    if (false === $this->admin->isGranted('LIST')) {
      throw new AccessDeniedException();
    }

    $datagrid = $this->admin->getDatagrid();
    $formView = $datagrid->getForm()->createView();

    //add by jims
    if ($datagrid->getResults()) {
      foreach ($datagrid->getResults() as $key => $result){

        if (is_file($_SERVER["DOCUMENT_ROOT"].'/uploads/user/'.$result->getPath())){
          $datagrid->getResults()[$key]->pic_exists = true;
        } else {
          $datagrid->getResults()[$key]->pic_exists = false;
        }

      }
    }

    // set the theme for the current Admin Form
    $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

    return $this->render($this->admin->getTemplate('list'), array(
      'action'     => 'list',
      'form'       => $formView,
      'datagrid'   => $datagrid,
      'csrf_token' => $this->getCsrfToken('sonata.batch'),
    ));


  }

}