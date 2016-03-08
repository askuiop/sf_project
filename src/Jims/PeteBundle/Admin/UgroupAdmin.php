<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2015/12/18
 * Time: 16:05
 */

namespace Jims\PeteBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class UgroupAdmin extends Admin
{
  /**
  * Default Datagrid values
  *
  * @var array
  */
  protected $datagridValues = array(
    'isAvailable' => array('type' => 2, 'value' => 0), //字段 类型2 >0
    '_page' => 1, // Display the first page (default = 1)
    '_sort_order' => 'DESC', // Descendant ordering (default = 'ASC')
    '_sort_by' => 'id' // name of the ordered field (default = the model id field, if any)
    // the '_sort_by' key can be of the form 'mySubModel.mySubSubModel.myField'.
  );


  // Fields to be shown on create/edit forms
  protected function configureFormFields(FormMapper $formMapper)
  {
    $formMapper
      ->with('General')
      ->add('id')
      ->add('groupName')
      ->setHelps(array(
        'id' => 'this is id',
        'groupName' => 'this is groupName',
      ))
      ->end()
      ->with("another")
      ->add('isAvailable')
      ->end()
    ;
  }

  // Fields to be shown on filter forms
  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
    $datagridMapper
      ->add('id')
      ->add('groupName')
    ;
  }

  // Fields to be shown on lists
  protected function configureListFields(ListMapper $listMapper)
  {
    $listMapper
      ->addIdentifier('id')
      ->add('groupName')
      // You may also specify the actions you want to be displayed in the list
      ->add('_action', 'actions', array(
        'actions' => array(
          'show' => array(),
          'edit' => array(),
          'delete' => array(),
        )
      ))
    ;
  }
  // Fields to be shown on show action
  protected function configureShowFields(ShowMapper $showMapper)
  {
    $showMapper
      ->add('id')
      ->add('groupName')
    ;
  }

}