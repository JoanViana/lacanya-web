<?php

namespace JV\TaskBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use JV\TaskBundle\Entity\Task;
use JV\TaskBundle\Form\TaskType;

/**
 * Task controller.
 *
 */
class TaskController extends Controller
{
    /**
     * Lists all Task entities.
     *
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tasks = $em->getRepository('JVTaskBundle:Task')->findAll();
        
        if (count($tasks) === 0) {
            return $this->render('JVTaskBundle:Task:list.html.twig', array("flashnotasks" => true));
        }
        
        return $this->render('JVTaskBundle:Task:list.html.twig', array(
            'tasks' => $tasks,
        ));
    }

    /**
     * Creates a new Task entity.
     *
     */
    public function newAction(Request $request)
    {
        $task = new Task();
        $form = $this->createForm('JV\TaskBundle\Form\TaskType', $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('task_show', array('id' => $task->getId()));
        }

        return $this->render('JVTaskBundle:Task:new.html.twig', array(
            'task' => $task,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Task entity.
     *
     */
    public function showAction(Task $task)
    {
        $deleteForm = $this->createDeleteForm($task);

        return $this->render('JVTaskBundle:Task:show.html.twig', array(
            'task' => $task,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Task entity.
     *
     */
    public function editAction(Request $request, Task $task)
    {
        $deleteForm = $this->createDeleteForm($task);
        $editForm = $this->createForm('JV\TaskBundle\Form\TaskType', $task);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('task_edit', array('id' => $task->getId()));
        }

        return $this->render('JVTaskBundle:Task:edit.html.twig', array(
            'task' => $task,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Task entity.
     *
     */
    public function deleteAction(Request $request, Task $task)
    {
        $form = $this->createDeleteForm($task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($task);
            $em->flush();
        }

        return $this->redirectToRoute('task_index');
    }

    /**
     * Creates a form to delete a Task entity.
     *
     * @param Task $task The Task entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Task $task)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('task_delete', array('id' => $task->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
     public function listByTypeAction(Type $type) {

        $tasks = $type->getTasks();

        return $this->render('JVTaskBundle:Task:listByType.html.twig', array('tasks' => $tasks,
        'type'=> $type
        ));
    }

    public function listAllByTypeAction() {
        
        $em = $this->getDoctrine()->getManager();

        $types = $em->getRepository('JVTaskBundle:Type')->findAll();
        
        if (count($types) === 0) {

            return $this->render('JVTaskBundle:Task:list.html.twig', array('flashnotypes' => true));
        }

        return $this->render('JVTaskBundle:Task:listAllByType.html.twig', array('types' => $types,
        ));
    }
    
    public function listByProjectAction(Project $project) {

        $tasks = $project->getTasks();

        return $this->render('JVTaskBundle:Task:listByProject.html.twig', array('tasks' => $tasks,
        'project'=> $project
        ));
    }

    public function listAllByProjectAction() {
        
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('JVTaskBundle:Project')->findAll();
        
        if (count($projects) === 0) {

            return $this->render('JVTaskBundle:Task:list.html.twig', array('flashnoprojects' => true));
        }

        return $this->render('JVTaskBundle:Task:listAllByProject.html.twig', array('projects' => $projects,
        ));
    }
    
    public function listByUserAction(User $user) {

        $tasks = $user->getTasks();

        return $this->render('JVTaskBundle:Task:listByUser.html.twig', array('tasks' => $tasks,
        'user'=> $user
        ));
    }

    public function listAllByUserAction() {
        
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('JVTaskBundle:User')->findAll();
        
        if (count($users) === 0) {

            return $this->render('JVTaskBundle:Task:list.html.twig', array('flashnousers' => true));
        }

        return $this->render('JVTaskBundle:Task:listAllByUser.html.twig', array('users' => $users,
        ));
    }
    
}
