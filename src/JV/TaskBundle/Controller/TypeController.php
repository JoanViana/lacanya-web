<?php

namespace JV\TaskBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use JV\TaskBundle\Entity\Type;
use JV\TaskBundle\Form\TypeType;

/**
 * Type controller.
 *
 */
class TypeController extends Controller
{
    /**
     * Lists all Type entities.
     *
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $types = $em->getRepository('JVTaskBundle:Type')->findAll();
        
        if (count($types) === 0) {
            return $this->render('JVTaskBundle:Type:list.html.twig', array("flashnotypes" => true));
        }

        return $this->render('JVTaskBundle:Type:list.html.twig', array(
            'types' => $types,
        ));
    }

    /**
     * Creates a new Type entity.
     *
     */
    public function newAction(Request $request)
    {
        $type = new Type();
        $form = $this->createForm('JV\TaskBundle\Form\TypeType', $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($type);
            $em->flush();

            return $this->redirectToRoute('type_show', array('id' => $type->getId()));
        }

        return $this->render('JVTaskBundle:Type:new.html.twig', array(
            'type' => $type,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Type entity.
     *
     */
    public function showAction(Type $type)
    {
        $deleteForm = $this->createDeleteForm($type);

        return $this->render('JVTaskBundle:Type:show.html.twig', array(
            'type' => $type,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Type entity.
     *
     */
    public function editAction(Request $request, Type $type)
    {
        $deleteForm = $this->createDeleteForm($type);
        $editForm = $this->createForm('JV\TaskBundle\Form\TypeType', $type);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($type);
            $em->flush();

            return $this->redirectToRoute('type_edit', array('id' => $type->getId()));
        }

        return $this->render('JVTaskBundle:Type:edit.html.twig', array(
            'type' => $type,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Type entity.
     *
     */
    public function deleteAction(Request $request, Type $type)
    {
        $form = $this->createDeleteForm($type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($type);
            $em->flush();
        }

        return $this->redirectToRoute('type_index');
    }

    /**
     * Creates a form to delete a Type entity.
     *
     * @param Type $type The Type entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Type $type)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('type_delete', array('id' => $type->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
