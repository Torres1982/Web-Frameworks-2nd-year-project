<?php
/**
 * Created by B00073668
 * @author - Artur Sukiennik
 * @since - 2016
 */
namespace Itb\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MainController - manages 'main' actions
 * @package Itb\Controller
 */
class MainController
{
    /**
     * Render the Index page template
     * @param Request $request
     * @param Application $app
     * @return array
     */
    public function indexAction(Request $request, Application $app)
    {
        $argsArray = [];

        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Not found error page
     * @param \Silex\Application $app
     * @param $message
     * @return array
     */
    public static function error404(Application $app, $message)
    {
        $argsArray = [
            'name' => 'User',
        ];
        $templateName = '404';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }
}
