<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2015/12/20
 * Time: 19:02
 */

namespace Jims\PeteBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class UserAdmin extends Admin
{
  public $data = null;

  // Fields to be shown on create/edit forms
  protected function configureFormFields(FormMapper $formMapper)
  {
    $subject = $this->getSubject(); //获取对象

    //$this->id($this->getSubject())
    ////If it returns true it is an edit form, if it is false, it is a create form.

    // use $fileFieldOptions so we can add other options to the field
    //'data_class' => 'Symfony\Component\HttpFoundation\File\File',
    $fileFieldOptions = ['label' => '图片', 'required' => false, 'data_class' => null];

    if ($subject && $subject->getPath()) { //判断图片路径是否存在
      //$container = $this->getConfigurationPool()->getContainer();
      $fullPath = $subject->getPath();

      $fileFieldOptions['help'] = '<img src="/uploads/user/' . $fullPath . '"  style="width:200px;" />';
    }

    $formMapper
      ->add('id')
      ->add('account')
      ->add('ugroups', null, array(
        'label' => '用户类型',

        //'expanded' => true,
        //'by_reference' => false,
        //'multiple' => true,
        'property' => 'groupName',
      ))
      ->add('isAvailable' )
      ->add('createdAt',  'sonata_type_datetime_picker',array(
        'label'               => '创建时间',
        'dp_language'         =>'cn',
        'format'              =>'yyyy-MM-dd HH:mm:ss',
        'dp_side_by_side'       => false,
        'dp_use_current'        => true,
        'dp_use_seconds'        => false,
      ))
      ->add('UpdatedAt',  'sonata_type_datetime_picker')
      ->add('username')
      ->add('password')
      ->add('path', 'file', $fileFieldOptions)
      ->add('avatar')
    ;
  }

  // Fields to be shown on filter forms
  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
    $datagridMapper
      ->add('id')
      ->add('account')
      ->add('isAvailable')
      ->add('createdAt' , 'doctrine_orm_date_range', array(
          'field_type' => 'sonata_type_date_range_picker',
        ))
      ->add('UpdatedAt')
      ->add('username')
    ;
  }

  // Fields to be shown on lists
  protected function configureListFields(ListMapper $listMapper)
  {
    $this->data = array(
      'jims' => 'pete'
    );

    $listMapper
      ->addIdentifier('id')
      ->add('account')
      ->add('ugroups', 'entity', array(
        'label' => '用户类型',
        //'expanded' => true,
        //'by_reference' => false,
        //'multiple' => true,
        'associated_property' => 'groupName'
      ))
      ->add('isAvailable' , null, array('editable' => true))
      ->add('createdAt')
      ->add('UpdatedAt')
      ->add('username')
      ->add('path', null, array(
        'template' => 'JimsPeteBundle:Admin:list_image.html.twig',
          'has_image_flag' => isset($fullPath)?true:false,
          )
      )
      ->add('avatar')

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
    $subject = $this->getSubject(); //获取对象
    //var_dump($subject);

    //$this->id($this->getSubject())
    ////If it returns true it is an edit form, if it is false, it is a create form.

    // use $fileFieldOptions so we can add other options to the field
    $fileFieldOptions = ['label' => '图片', 'required' => false, 'data_class' => null];
    if ($subject && $subject->getPath()) { //判断图片路径是否存在
      //$container = $this->getConfigurationPool()->getContainer();
      $fullPath = $subject->getPath();

      $fileFieldOptions['help'] = '<img src="/uploads/user/' . $fullPath . '"  style="width:200px;" />';
    }
    $showMapper
      ->add('id')
      ->add('account')
      ->add('isAvailable')
      ->add('createdAt')
      ->add('UpdatedAt')
      ->add('username')
      ->add('path', 'file' , $fileFieldOptions)
      ->add('avatar')
    ;
  }

  public function getTemplate($name)
  {
    switch ($name) {
      case 'xxx':
        return 'YourBundle:Sonata:base_edit.html.twig';
        break;
      default:
        return parent::getTemplate($name);
        break;
    }
  }

  public function getFilterParameters()
  {
    $this->datagridValues = array_merge(
      array(
        'isAvailable' => array (
          //'type' => 1,
          'value' => 0
        ),
        /*
        // exemple with date range
        'updatedAt' => array(
          'type' => 1,
          'value' => array(
            'start' => array(
              'day' => date('j'),
              'month' => date('m'),
              'year' => date('Y')
            ),
            'end' => array(
              'day' => date('j'),
              'month' => date('m'),
              'year' => date('Y')
            )
          ),
        )*/
      ),
      $this->datagridValues
    );

    return parent::getFilterParameters();
  }

  public function createQuery($context = 'list')
  {
    $query = parent::createQuery($context);
    $query->andWhere(
      $query->expr()->eq($query->getRootAlias() . '.isAvailable', ':my_param')
    );
    $query->setParameter('my_param', 1);
    return $query;
  }

}