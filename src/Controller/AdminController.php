<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{
    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;
    private $manager;

    public function __construct(AuthenticationUtils $authenticationUtils, EntityManagerInterface $manager)
    {
        $this->authenticationUtils = $authenticationUtils;
        $this->manager = $manager;
    }

    /**
     * @Route("/admin/login", name="admin_login")
     */
    public function login(): Response
    {
        $error = $this->authenticationUtils->getLastAuthenticationError();
        return $this->render('admin/login.html.twig',[
            'error' => $error !== null
        ]);
    }

    /**
     * @Route("/admin/logout", name="admin_logout")
     */
    public function logout(): Response
    {
        return new JsonResponse();
    }

    /**
     * @Route("/admin/projects", name="admin_projects")
     */
    public function projects(ProjectRepository $repository): Response
    {
        return $this->render('admin/projects.html.twig',[
            'projects' => $repository->findAll()
        ]);
    }

    /**
     * @Route("/admin/projects/new",name="admin_project_new")
     */
    public function new(Request $request) :Response {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dd($project);
            $this->manager->persist($project);
            $this->manager->flush();
            return $this->redirectToRoute('admin_projects');
        }

        return $this->render('admin/new.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/projects/{id}/delete",name="admin_projects_delete")
     */
    public function delete(Project $project) {
        $this->manager->remove($project);
        $this->manager->flush();
        return $this->redirectToRoute('admin_projects');
    }

    /**
     * @Route("/admin/projects/{id}/edit",name="admin_projects_edit")
     */
    public function edit(Project $project, Request $request) {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dd($project);
            $this->manager->persist($project);
            $this->manager->flush();
            return $this->redirectToRoute('admin_projects');
        }

        return $this->render('admin/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
