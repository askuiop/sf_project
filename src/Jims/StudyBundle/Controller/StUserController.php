<?php

namespace Jims\StudyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Jims\StudyBundle\Entity\StUser;
use Jims\StudyBundle\Form\StUserType;

/**
 * StUser controller.
 *
 */
class StUserController extends Controller
{

    /**
     * Lists all StUser entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('JimsStudyBundle:StUser')->findAll();

        return $this->render('JimsStudyBundle:StUser:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new StUser entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new StUser();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('stuser_show', array('id' => $entity->getId())));
        }

        return $this->render('JimsStudyBundle:StUser:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a StUser entity.
     *
     * @param StUser $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(StUser $entity)
    {
        $form = $this->createForm(new StUserType(), $entity, array(
            'action' => $this->generateUrl('stuser_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new StUser entity.
     *
     */
    public function newAction()
    {
        $entity = new StUser();
        $form   = $this->createCreateForm($entity);

        return $this->render('JimsStudyBundle:StUser:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a StUser entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JimsStudyBundle:StUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JimsStudyBundle:StUser:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing StUser entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JimsStudyBundle:StUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StUser entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JimsStudyBundle:StUser:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a StUser entity.
    *
    * @param StUser $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(StUser $entity)
    {
        $form = $this->createForm(new StUserType(), $entity, array(
            'action' => $this->generateUrl('stuser_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing StUser entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JimsStudyBundle:StUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('stuser_edit', array('id' => $id)));
        }

        return $this->render('JimsStudyBundle:StUser:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a StUser entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('JimsStudyBundle:StUser')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find StUser entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('stuser'));
    }

    /**
     * Creates a form to delete a StUser entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('stuser_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
