<?php

namespace DW\ComReminderBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DW\ComReminderBundle\Entity\Remind;
use DW\ComReminderBundle\Form\RemindType;

/**
 * Remind controller.
 *
 * @Route("/remind")
 */
class RemindController extends Controller
{
    /**
     * Lists all Remind entities.
     *
     * @Route("/", name="remind")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DWComReminderBundle:Remind')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Remind entity.
     *
     * @Route("/", name="remind_create")
     * @Method("POST")
     * @Template("DWComReminderBundle:Remind:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Remind();
        $form = $this->createForm(new RemindType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('remind_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Remind entity.
     *
     * @Route("/new", name="remind_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Remind();
        $form   = $this->createForm(new RemindType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Remind entity.
     *
     * @Route("/{id}", name="remind_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DWComReminderBundle:Remind')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Remind entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Remind entity.
     *
     * @Route("/{id}/edit", name="remind_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DWComReminderBundle:Remind')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Remind entity.');
        }

        $editForm = $this->createForm(new RemindType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Remind entity.
     *
     * @Route("/{id}", name="remind_update")
     * @Method("PUT")
     * @Template("DWComReminderBundle:Remind:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DWComReminderBundle:Remind')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Remind entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new RemindType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('remind_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Remind entity.
     *
     * @Route("/{id}", name="remind_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DWComReminderBundle:Remind')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Remind entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('remind'));
    }

    /**
     * Creates a form to delete a Remind entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
