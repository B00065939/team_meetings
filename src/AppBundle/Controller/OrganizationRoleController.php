<?php
/**
 * Created by PhpStorm.
 * User: bemben
 * Date: 15/11/2016
 * Time: 08:59
 */

namespace AppBundle\Controller;


use AppBundle\Form\OrganizationRoleFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrganizationRoleController extends Controller
{

    public function listAction() {
        $em = $this->getDoctrine()->getManager();
        $roles = $em->getRepository('AppBundle:OrganizationRole')->findAll();
        return $this->render(':organization_role:list.html.twig',
            array(
                'roles' => $roles
            ));
    }


    public function newAction(Request $request)
    {
        $form = $this->createForm(OrganizationRoleFormType::class);

        //only handles data on POST
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $organizationRole = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($organizationRole);
            $em->flush();

            $this->addFlash('success', 'Organization Role Created!');
            return $this->redirectToRoute('organization_role_list');
        }

        return $this->render('organization_role/new.html.twig', [
            'newOrganizationRoleForm' => $form->createView()
        ]);

    }

}