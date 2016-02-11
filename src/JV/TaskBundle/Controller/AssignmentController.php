<?php

namespace JV\TaskBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use JV\TaskBundle\Entity\Assignment;
use JV\TaskBundle\Form\AssignmentType;

/**
 * Assignment controller.
 *
 */
class AssignmentController extends Controller
{
    /**
     * Lists all Assignment entities.
     *
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $assignments = $em->getRepository('JVTaskBundle:Assignment')->findAll();
        
        if (count($assignments) === 0) {
            return $this->render("assignment/index.html.twig", array("flashnoassignments" => true));
        }

        return $this->render('assignment/list.html.twig', array(
            'assignments' => $assignments,
        ));
    }

    /**
     * Creates a new Assignment entity.
     *
     */
    public function newAction(Request $request)
    {
        $assignment = new Assignment();
        $form = $this->createForm('JV\TaskBundle\Form\AssignmentType', $assignment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($assignment);
            $em->flush();

            return $this->redirectToRoute('assignment_show', array('id' => $assignment->getId()));
        }

        return $this->render('assignment/new.html.twig', array(
            'assignment' => $assignment,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Assignment entity.
     *
     */
    public function showAction(Assignment $assignment)
    {
        $deleteForm = $this->createDeleteForm($assignment);

        return $this->render('assignment/show.html.twig', array(
            'assignment' => $assignment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Assignment entity.
     *
     */
    public function editAction(Request $request, Assignment $assignment)
    {
        $deleteForm = $this->createDeleteForm($assignment);
        $editForm = $this->createForm('JV\TaskBundle\Form\AssignmentType', $assignment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($assignment);
            $em->flush();

            return $this->redirectToRoute('assignment_edit', array('id' => $assignment->getId()));
        }

        return $this->render('assignment/edit.html.twig', array(
            'assignment' => $assignment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Assignment entity.
     *
     */
    public function deleteAction(Request $request, Assignment $assignment)
    {
        $form = $this->createDeleteForm($assignment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($assignment);
            $em->flush();
        }

        return $this->redirectToRoute('assignment_index');
    }

    /**
     * Creates a form to delete a Assignment entity.
     *
     * @param Assignment $assignment The Assignment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Assignment $assignment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('assignment_delete', array('id' => $assignment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    public function listByUserAction(User $user) {

        $assignments = $user->getAssignments();

        return $this->render('assignment/listByUser.html.twig', array('assignments' => $assignments,
        'user'=> $user
        ));
    }

    public function listAllByUserAction() {
        
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('JVTaskBundle:User')->findAll();
        
        if (count($users) === 0) {

            return $this->render('assignment/index.html.twig', array('flashnousers' => true));
        }

        return $this->render('assignment/listAllByUser.html.twig', array('users' => $users,
        ));
    }
    
    public function listByProjectAction(Project $project) {

        $assignments = $project->getAssignments();

        return $this->render('assignment/listByProject.html.twig', array('assignments' => $assignments,
        'project'=> $project
        ));
    }

    public function listAllByProjectAction() {
        
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('JVTaskBundle:Project')->findAll();
        
        if (count($projects) === 0) {

            return $this->render('assignment/index.html.twig', array('flashnoprojects' => true));
        }

        return $this->render('assignment/listAllByProject.html.twig', array('projects' => $projects,
        ));
    }
}
