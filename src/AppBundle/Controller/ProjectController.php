<?php
/**
 * Created by PhpStorm.
 * User: bemben
 * Date: 15/11/2016
 * Time: 08:59
 */

namespace AppBundle\Controller;


use AppBundle\Form\OrganizationRoleFormType;
use AppBundle\Form\ProjectFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProjectController extends Controller
{

    public function listAction() {
        $em = $this->getDoctrine()->getManager();
        $projects = $em->getRepository('AppBundle:Project')->findAll();
        return $this->render(':project:list.html.twig',
            array(
                'projects' => $projects
            ));
    }


    public function newAction(Request $request)
    {
        $form = $this->createForm(ProjectFormType::class);

        //only handles data on POST
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $organizationRole = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($organizationRole);
            $em->flush();

            $this->addFlash('success', 'Project Created!');
            return $this->redirectToRoute('project_list');
        }

        return $this->render('project/new.html.twig', [
            'newProjectForm' => $form->createView()
        ]);

    }

}