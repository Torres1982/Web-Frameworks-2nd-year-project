<?php
/**
 * Created by B00073668
 * @author - Artur Sukiennik
 * @since - 2016
 */
namespace Itb\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Itb\Model\Login;
use Itb\Model\Member;
use Itb\Model\Project;
use Itb\Model\Publication;
use Itb\Model\Student;

/**
 * Class ProjectController - manages 'projects' actions
 * @package Itb\Controller
 */
class ProjectController
{
    /**
     * Display 'project' public page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function projectsAction(Request $request, Application $app)
    {
        $projects = Project::getAll();
        $fieldName = 'all';

        $argsArray = [
            'projects' => $projects,
            'status' => $fieldName
        ];

        $templateName = 'projects';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Display only current Projects table
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function showCurrentProjectsAction(Request $request, Application $app)
    {
        $projectStatus = 'projectStatus';
        $fieldName = 'current';

        $projects = Project::searchByColumn($projectStatus, $fieldName);

        $argsArray = [
            'projects' => $projects,
            'status' => $fieldName
        ];

        $templateName = 'projects';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Display only past Projects table
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function showPastProjectsAction(Request $request, Application $app)
    {
        $projectStatus = 'projectStatus';
        $fieldName = 'past';

        $projects = Project::searchByColumn($projectStatus, $fieldName);

        $argsArray = [
            'projects' => $projects,
            'status' => $fieldName
        ];

        $templateName = 'projects';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }
}
