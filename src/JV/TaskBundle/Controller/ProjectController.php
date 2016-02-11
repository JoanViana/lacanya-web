<?php

namespace JV\TaskBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use JV\TaskBundle\Entity\Project;
use JV\TaskBundle\Form\ProjectType;

/**
 * Project controller.
 *
 */
class ProjectController extends Controller
{
    /**
     * Lists all Project entities.
     *
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('JVTaskBundle:Project')->findAll();

        if (count($projects) === 0) {
            return $this->render("project/index.html.twig", array("flashnoprojects" => true));
        }
        
        return $this->render('project/list.html.twig', array(
            'projects' => $projects,
        ));
    }

    /**
     * Creates a new Project entity.
     *
     */
    public function newAction(Request $request)
    {
        $project = new Project();
        $form = $this->createForm('JV\TaskBundle\Form\ProjectType', $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('project_show', array('id' => $project->getId()));
        }

        return $this->render('project/new.html.twig', array(
            'project' => $project,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Project entity.
     *
     */
    public function showAction(Project $project)
    {
        $deleteForm = $this->createDeleteForm($project);

        return $this->render('project/show.html.twig', array(
            'project' => $project,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Project entity.
     *
     */
    public function editAction(Request $request, Project $project)
    {
        $deleteForm = $this->createDeleteForm($project);
        $editForm = $this->createForm('JV\TaskBundle\Form\ProjectType', $project);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('project_edit', array('id' => $project->getId()));
        }

        return $this->render('project/edit.html.twig', array(
            'project' => $project,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Project entity.
     *
     */
    public function deleteAction(Request $request, Project $project)
    {
        $form = $this->createDeleteForm($project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($project);
            $em->flush();
        }

        return $this->redirectToRoute('project_index');
    }

    /**
     * Creates a form to delete a Project entity.
     *
     * @param Project $project The Project entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Project $project)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('project_delete', array('id' => $project->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function listByCategoryAction(Category $category) {

        $projects = $category->getProjects();

        return $this->render('project/listByCategory.html.twig', array('projects' => $projects,
        'category'=> $category
        ));
    }

    public function listAllByCategoryAction() {
        
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('JVTaskBundle:Category')->findAll();
        
        if (count($categories) === 0) {

            return $this->render('project/index.html.twig', array('flashnocategories' => true));
        }

        return $this->render('project/listAllByCategory.html.twig', array('categories' => $categories,
        ));
    }

    
}
