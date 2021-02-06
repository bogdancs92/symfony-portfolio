<?php


namespace App\Controller;


use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends  AbstractController
{
    /**
     * @Route("/projects", name="projects")
     */
    public function index(ProjectRepository $repository): Response
    {
        $projects = $repository->findAll();
        //dd($projects);
        return $this->render('projects/projects.html.twig', [
            'controller_name' => 'ProjectController',
            'projects'=>$projects
        ]);
    }

    /**
     * @Route("/projects/{id}",name="project_detail")
     */
    public function showByPk(Project $project) :Response
    {
        return $this->render("projects/project.html.twig",[
            'project' => $project
        ]);
    }

}