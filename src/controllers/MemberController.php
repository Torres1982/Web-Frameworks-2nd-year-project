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
 * Class MemberController - manages 'members' actions
 * @package Itb\Controller
 */
class MemberController
{
    /**
     * Get members details from Database
     * @param Request $request
     * @param Application $app
     * @return array
     */
    public function membersAction(Request $request, Application $app)
    {
        $members = Member::getAll();
        $fieldName = 'all';

        $argsArray = [
            'members' => $members,
            'status' => $fieldName
        ];

        $templateName = 'members';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect the member to the member index page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function memberIndexAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $argsArray = [
            'userSession' => $localUser
        ];

        $templateName = 'memberIndex';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Filter the Members - show only the current Members
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function showCurrentMembersAction(Request $request, Application $app)
    {
        $memberStatus = 'memberStatus';
        $fieldName = 'current';

        $members = Member::searchByColumn($memberStatus, $fieldName);

        $argsArray = [
            'members' => $members,
            'status' => $fieldName
        ];

        $templateName = 'members';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Filter the Members - show only the past Members
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function showPastMembersAction(Request $request, Application $app)
    {
        $memberStatus = 'memberStatus';
        $fieldName = 'past';

        $members = Member::searchByColumn($memberStatus, $fieldName);

        $argsArray = [
            'members' => $members,
            'status' => $fieldName
        ];

        $templateName = 'members';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }
}
