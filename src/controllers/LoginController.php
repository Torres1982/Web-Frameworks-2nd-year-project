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
 * Testing new Repository
 * Class LoginController - manages 'login' actions
 * @package Itb\Controller
 */
class LoginController
{
    /**
     * Log in the user
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function processLoginAction(Request $request, Application $app)
    {
        // Set the 'user logged in' session to false (default value)
        $_SESSION['isUserLoggedIn'] = false;

        // Retrieve user details from the text input (username and password)
        $usernameFromInput = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $passwordFromInput = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        // Retrieve details from Database
        $user = Login::getOneByUsername($usernameFromInput);

        // If username from input field is not empty and password is verified
        if ($user) {

            // Retrieve details from Database
            $usernameFromDb = $user->getUsername();
            //$passwordFromDb = $user->getPassword();

            $isPresent = Login::matchUserWithPassword($usernameFromInput, $passwordFromInput);
            $isRole = Login::matchUserWithRole($usernameFromDb);

            if ($usernameFromInput != $usernameFromDb) {
                return $app->redirect('/index');
            }

            // If username exists, and password matches
            if ($isPresent != null) {

                // Store username in 'user' in 'session'
                $app['session']->set('user', array('username' => $usernameFromDb));

                // Set the 'user logged in' session to true
                $_SESSION['isUserLoggedIn'] = true;

                // If role is assigned to the user, redirect the user to the specific page
                if ($isRole) {
                    if ($user->getRole() == 'admin') {
                        return $app->redirect('/adminIndex');
                    } elseif ($user->getRole() == 'student') {
                        return $app->redirect('/studentIndex');
                    } elseif ($user->getRole() == 'member') {
                        return $app->redirect('/memberIndex');
                    }
                }
            }
        }

        $argsArray = [
            'loginError' => 'Wrong Username or Password! Try again!'
        ];

        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect the user to the public index page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function logoutAction(Request $request, Application $app)
    {
        // If any of the users is logged in, log her/him out and clear info from session
        $app['session']->set('user', null);

        // Kill the session on logout
        session_destroy();

        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig', []);
    }

    /**
     * Check if the username exists in the Database 'login' table
     * Hash the Password and verify it
     * @param $username
     * @param $password
     * @return bool
     */
    public static function matchUserWithPassword($username, $password)
    {
        $user = Login::getOneByUsername($username);
        $passwordHashed = $user->getPassword();

        // if username does not exist, return FALSE
        if (null == $user) {
            return false;
        } else {
            return password_verify($password, $passwordHashed);
        }
    }
}
