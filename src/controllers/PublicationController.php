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
 * Class PublicationController - manages 'publications' actions
 * @package Itb\Controller
 */
class PublicationController
{
    /**
     * Publications public page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function publicationsAction(Request $request, Application $app)
    {
        $publications = Publication::getAll();

        $argsArray = [
          'publications' => $publications,
        ];

        $templateName = 'publications';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }
}
