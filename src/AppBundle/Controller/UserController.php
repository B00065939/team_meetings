<?php
/**
 * Created by PhpStorm.
 * User: bemben
 * Date: 15/11/2016
 * Time: 06:54
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\UserFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('user/showuserlist.html.twig',
            array(
                'users' => $users
            ));
    }

    public function userAction($userId)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneBy(['id' => $userId]);
        return $this->render('user/showuser.html.twig',
            array(
                'user' => $user
            ));
    }

    public function newUserAction(Request $request)
    {
        $form = $this->createForm(UserFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Genus created!');
            return $this->redirectToRoute('userlist');
        }
        return $this->render('user/newuser.html.twig', [
            'newUserForm' => $form->createView()
        ]);
    }
}