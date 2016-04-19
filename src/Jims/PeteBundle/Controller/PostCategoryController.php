<?php

namespace Jims\PeteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Jims\PeteBundle\Entity\PostCategory;
use Jims\PeteBundle\Form\PostCategoryType;

/**
 * PostCategory controller.
 *
 */
class PostCategoryController extends Controller
{

    /**
     * Lists all PostCategory entities.
     *
     */
    public function indexAction()
    {
        $this->enforceSecurity();


        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('JimsPeteBundle:PostCategory')->findAll();

        return $this->render('JimsPeteBundle:PostCategory:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new PostCategory entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new PostCategory();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('postcategory_show', array('id' => $entity->getId())));
        }

        return $this->render('JimsPeteBundle:PostCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a PostCategory entity.
     *
     * @param PostCategory $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PostCategory $entity)
    {
        $form = $this->createForm(new PostCategoryType(), $entity, array(
            'action' => $this->generateUrl('postcategory_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new PostCategory entity.
     *
     */
    public function newAction()
    {
        $entity = new PostCategory();
        $form   = $this->createCreateForm($entity);

        return $this->render('JimsPeteBundle:PostCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PostCategory entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JimsPeteBundle:PostCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JimsPeteBundle:PostCategory:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PostCategory entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JimsPeteBundle:PostCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostCategory entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JimsPeteBundle:PostCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a PostCategory entity.
    *
    * @param PostCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PostCategory $entity)
    {
        $form = $this->createForm(new PostCategoryType(), $entity, array(
            'action' => $this->generateUrl('postcategory_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PostCategory entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JimsPeteBundle:PostCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('postcategory_edit', array('id' => $id)));
        }

        return $this->render('JimsPeteBundle:PostCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a PostCategory entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('JimsPeteBundle:PostCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PostCategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('postcategory'));
    }

    /**
     * Creates a form to delete a PostCategory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('postcategory_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    private function enforceSecurity()
    {
        //$this->denyAccessUnlessGranted('ROLE_USER', null, 'access denied');  //new way
        // old way:
        //if (false === $this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
        //    throw $this->createAccessDeniedException('access denied');
        //}

        if (false === $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException('access denied');
        }
    }
}
