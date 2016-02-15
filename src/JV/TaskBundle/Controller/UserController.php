<?php

namespace JV\TaskBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Sec;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

use FOS\UserBundle\Controller\SecurityController;

use JV\TaskBundle\Entity\User;
use JV\TaskBundle\Form\UserType;

/**
 * User controller.
 *
 */
class UserController extends SecurityController
{
    protected function renderLogin(array $data)
    {
        return $this->render('JVTaskBundle:FOSUserBundle:Security:loginUsername.html.twig', $data);
    }

    /**
     * Lists all User entities.
     * @Sec("has_role('ROLE_APP_ADMIN')")
     *
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('JVTaskBundle:User')->findAll();
        
        if (count($users) === 0) {
            return $this->render('JVTaskBundle:User:list.html.twig', array("flashnousers" => true));
        }

        return $this->render('JVTaskBundle:User:list.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Creates a new User entity.
     * @Sec("has_role('ROLE_APP_ADMIN')")
     *
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('JV\TaskBundle\Form\UserType', $user);
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($encoded);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_show', array('id' => $user->getId(),
            "flashuseradd" => true));
        }

        return $this->render('JVTaskBundle:User:new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a User entity.
     * @Sec("has_role('ROLE_APP_ADMIN'||'ROLE_USER')")
     *
     */
    public function showAction(User $user)
    {
        $usernow = $this->getUser();
        $userId = $usernow->getId();
        
        $id = $user->getId();
        
        if ($userId != $id){
            return $this->render('JVTaskBundle:Task:listByUser.html.twig', array(
                "user" => $usernow,
                "tasks" => $usernow->getTasks(),
                "flashnousernow" => true));
        }
        else{
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('JVTaskBundle:User:show.html.twig', array(
            'user' => $user,
            'delete_form' => $deleteForm->createView(),
        ));
        }
    }

    /**
     * Displays a form to edit an existing User entity.
     * @Sec("has_role('ROLE_APP_ADMIN'||'ROLE_USER')")
     *
     */
    public function editAction(Request $request, User $user)
    {
        $usernow = $this->getUser();
        $userId = $usernow->getId();
        
        $id = $user->getId();
        
        if ($userId != $id){
            return $this->render('JVTaskBundle:Task:listByUser.html.twig', array(
                "user" => $usernow,
                "tasks" => $usernow->getTasks(),
                "flashnousernow" => true));
        }
        else{
        
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('JV\TaskBundle\Form\UserType', $user);
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($encoded);
        
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_edit', array('id' => $user->getId()));
        }

        return $this->render('JVTaskBundle:User:edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
        }
    }

    /**
     * Deletes a User entity.
     * @Sec("has_role('ROLE_APP_ADMIN')")
     *
     */
    public function deleteAction(Request $request, User $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * Creates a form to delete a User entity.
     *
     * @param User $user The User entity
     *
     * @return \Symfony\Component\Form\Form The form
     * @Sec("has_role('ROLE_APP_ADMIN')")
     *
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
