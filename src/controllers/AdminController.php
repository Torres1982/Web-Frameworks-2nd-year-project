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

// Start the session
session_start();

/**
 * Class AdminController - manages 'admin' actions
 * @package Itb\Controller
 */
class AdminController
{
    /**
     * Redirect Admin to the 'admin index' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminIndexAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $argsArray = [
            'userSession' => $localUser
        ];

        $templateName = 'adminIndex';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    //*********************************************
    //********** ADMIN INSERT ACTIONS *************
    //*********************************************
    /**
     * Redirect Admin to the 'admin create login user' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminCreateLoginUserAction(Request $request, Application $app)
    {
        if (isset($_SESSION['isUserLoggedIn'])) {
            if ($_SESSION['isUserLoggedIn'] = true) {
                $user = $app['session']->get('user');
                $localUser = $user['username'];

                $argsArray = [
                    'userSession' => $localUser
                ];

                $templateName = 'adminCreateLoginUser';
                return $app['twig']->render($templateName . '.html.twig', $argsArray);
            }
        }
    }

    /**
     * Redirect Admin to the 'admin create' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminCreateAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $argsArray = [
            'userSession' => $localUser
        ];

        $templateName = 'adminCreate';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect the Admin to the 'create student' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminCreateStudentAction(Request $request, Application $app)
    {
        if (isset($_SESSION['isUserLoggedIn'])) {
            if ($_SESSION['isUserLoggedIn'] != false) {
                $user = $app['session']->get('user');
                $localUser = $user['username'];

                $argsArray = [
                    'userSession' => $localUser
                ];

                $templateName = 'adminCreateStudent';
                return $app['twig']->render($templateName . '.html.twig', $argsArray);
            }
        }

        // If the session is not set and is not true - display error
        $errorMessage = 'You do not have rights to perform this operation!';

        $argsArray = [
            'confirmMessage' => $errorMessage
        ];

        $templateName = 'errorMessageSession';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'create member' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminCreateMemberAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $argsArray = [
            'userSession' => $localUser
        ];

        $templateName = 'adminCreateMember';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'create project' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminCreateProjectAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $argsArray = [
            'userSession' => $localUser
        ];

        $templateName = 'adminCreateProject';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'create publication' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminCreatePublicationAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $argsArray = [
            'userSession' => $localUser
        ];

        $templateName = 'adminCreatePublication';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Add a new Login User to the 'logins' Database table
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminInsertLoginUserIntoDbAction(Request $request, Application $app)
    {
        // Get data from the input fields
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $passwordRetype = filter_input(INPUT_POST, 'passwordRetype', FILTER_SANITIZE_STRING);
        $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);

        // Compare the password to the passwordRetype
        if ($password != $passwordRetype) {
            $argsArray = [
                'matchPasswordsErrorMessage' => 'Passwords do not match!'
                //return $app->redirect('/adminCreateLoginUser');
            ];
            $templateName = 'adminCreateLoginUser';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        }

        // Create new Logins and stored them in the Database
        $newLoginUser = new Login();
        $newLoginUser->setUsername($username);
        $newLoginUser->setPassword($password);
        $newLoginUser->setRole($role);

        // Create a new instance of Student (call custom sql query method from Student class)
        $loginInsertedSuccess = Login::insert($newLoginUser);

        if ($loginInsertedSuccess) {
            // Append a new Login details to a file
            $newAppendedLogin = new Login();
            $newAppendedLogin->appendUserLoginToFile($role, $username, $password);

            $argsArray = [
                'confirmMessage' => 'Student successfully added to the Database!'
            ];
        } else {
            $argsArray = [
                'confirmMessage' => 'Student could not be added to the Database!'
            ];
        }

        $templateName = 'confirmation';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Set the new Student and insert her/him to the Database 'students' table
     * @param Request $request
     * @param Application $app
     * @return string
     */
    public function adminInsertStudentIntoDbAction(Request $request, Application $app)
    {
        // Get data from the input fields
        $studentName = filter_input(INPUT_POST, 'studentName', FILTER_SANITIZE_STRING);
        $studentSurname = filter_input(INPUT_POST, 'studentSurname', FILTER_SANITIZE_STRING);
        $projectId = filter_input(INPUT_POST, 'projectId', FILTER_SANITIZE_NUMBER_INT);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $memberId = filter_input(INPUT_POST, 'memberId', FILTER_SANITIZE_NUMBER_INT);

        // Create the new Student and store her/his data in Database
        $newStudent = new Student();
        $newStudent->setStudentName($studentName);
        $newStudent->setStudentSurname($studentSurname);
        $newStudent->setProjectId($projectId);
        $newStudent->setEmail($email);
        $newStudent->setMemberId($memberId);

        //$insertStudent = new Student();
        //$studentInsertedSuccess = $insertStudent->insert($newStudent);

        $studentInsertedSuccess = Student::insert($newStudent);

        if ($studentInsertedSuccess) {
            $argsArray = [
                'confirmMessage' => 'Student successfully added to the Database!'
            ];
        } else {
            $argsArray = [
                'confirmMessage' => 'Student could not be added to the Database!'
            ];
        }

        $templateName = 'confirmation';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Set the new Member and insert her/him to the 'members' Database table
     * @param Request $request
     * @param Application $app
     * @return string
     */
    public function adminInsertMemberIntoDbAction(Request $request, Application $app)
    {
        // Get data from the input fields
        $memberName = filter_input(INPUT_POST, 'memberName', FILTER_SANITIZE_STRING);
        $memberSurname = filter_input(INPUT_POST, 'memberSurname', FILTER_SANITIZE_STRING);
        $projectId = filter_input(INPUT_POST, 'projectId', FILTER_SANITIZE_NUMBER_INT);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $memberStatus = filter_input(INPUT_POST, 'memberStatus', FILTER_SANITIZE_STRING);

        // Create the new Member and store her/his data in Database
        $newMember = new Member();
        $newMember->setMemberName($memberName);
        $newMember->setMemberSurname($memberSurname);
        $newMember->setProjectId($projectId);
        $newMember->setEmail($email);
        $newMember->setMemberStatus($memberStatus);

        $memberInsertedSuccess = Member::insert($newMember);

        if ($memberInsertedSuccess) {
            $argsArray = [
                'confirmMessage' => 'Member successfully added to the Database!'
            ];
        } else {
            $argsArray = [
                'confirmMessage' => 'Member could not be added to the Database!'
            ];
        }

        $templateName = 'confirmation';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Set the new Project and insert it to the 'projects' Database table
     * @param Request $request
     * @param Application $app
     * @return string
     */
    public function adminInsertProjectIntoDbAction(Request $request, Application $app)
    {
        // Get data from the input fields
        $projectName = filter_input(INPUT_POST, 'projectName', FILTER_SANITIZE_STRING);
        $projectTitle = filter_input(INPUT_POST, 'projectTitle', FILTER_SANITIZE_STRING);
        $projectSupervisor = filter_input(INPUT_POST, 'projectSupervisor', FILTER_SANITIZE_NUMBER_INT);
        $projectStatus = filter_input(INPUT_POST, 'projectStatus', FILTER_SANITIZE_STRING);

        // Create the new Project and store its data in Database
        $newProject = new Project();
        $newProject->setProjectName($projectName);
        $newProject->setProjectTitle($projectTitle);
        $newProject->setProjectSupervisor($projectSupervisor);
        $newProject->setProjectStatus($projectStatus);

        $projectInsertedSuccess = Project::insert($newProject);

        if ($projectInsertedSuccess) {
            $argsArray = [
                'confirmMessage' => 'Project successfully added to the Database!'
            ];
        } else {
            $argsArray = [
                'confirmMessage' => 'Project could not be added to the Database!'
            ];
        }

        $templateName = 'confirmation';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Set the new Publication and store its data in the 'publications' Database table
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminInsertPublicationIntoDbAction(Request $request, Application $app)
    {
        // Get the data from the input fields
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $authorId = filter_input(INPUT_POST, 'authorId', FILTER_SANITIZE_STRING);
        $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_STRING);
        $datePublished = filter_input(INPUT_POST, 'datePublished', FILTER_SANITIZE_STRING);

        // Create the new Publication and store its data in Database
        $newPublication = new Publication();
        $newPublication->setTitle($title);
        $newPublication->setAuthorId($authorId);
        $newPublication->setUrl($url);
        $newPublication->setDatePublished($datePublished);

        $publicationInsertedSuccess = Publication::insert($newPublication);

        if ($publicationInsertedSuccess) {
            $argsArray = [
                'confirmMessage' => 'Publication successfully added to the Database!'
            ];
        } else {
            $argsArray = [
                'confirmMessage' => 'Publication could not be added to the Database!'
            ];
        }

        $templateName = 'confirmation';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    //*********************************************
    //********** ADMIN DELETE ACTIONS *************
    //*********************************************
    /**
     * Redirect Admin to the 'admin delete' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminDeleteAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $argsArray = [
            'userSession' => $localUser
        ];

        $templateName = 'adminDelete';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'delete login user' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminDeleteLoginUserAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $logins = Login::getAll();

        $argsArray =[
            'logins' => $logins,
            'userSession' => $localUser
        ];

        $templateName = 'adminDeleteLoginUser';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'delete student' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminDeleteStudentAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $students = Student::getAll();

        $argsArray = [
            'students' => $students,
            'userSession' => $localUser
        ];

        $templateName = 'adminDeleteStudent';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'delete member' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminDeleteMemberAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $members = Member::getAll();

        $argsArray = [
            'members' => $members,
            'userSession' => $localUser
        ];

        $templateName = 'adminDeleteMember';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'delete project' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminDeleteProjectAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $projects = Project::getAll();

        $argsArray = [
            'projects' => $projects,
            'userSession' => $localUser
        ];

        $templateName = 'adminDeleteProject';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'delete publication' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminDeletePublicationAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $publications = Publication::getAll();

        $argsArray = [
            'publications' => $publications,
            'userSession' => $localUser
        ];

        $templateName = 'adminDeletePublication';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Delete Login User from the 'logins' Database table
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function adminDeleteLoginUserFromDbAction(Request $request, Application $app, $id)
    {
        $success = Login::delete($id);

        if ($success) {
            $argsArray = [
                'confirmMessage' => 'Login User with id ' . $id . ' successfully deleted from the Database!'
            ];
        } else {
            $argsArray = [
                'confirmMessage' => 'Login User with id ' . $id . ' could not be deleted from the Database!'
            ];
        }

        $templateName = 'confirmation';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Delete Student from the 'students' Database table
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function adminDeleteStudentFromDbAction(Request $request, Application $app, $id)
    {
        //$deleteStudent = new Student();
        //$success = $deleteStudent->delete($id);

        $success = Student::delete($id);

        if ($success) {
            $argsArray = [
                'confirmMessage' => 'Student with id ' . $id . ' successfully deleted from the Database!'
            ];
        } else {
            $argsArray = [
                'confirmMessage' => 'Student with id ' . $id . ' could not be deleted from the Database!'
            ];
        }

        $templateName = 'confirmation';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Delete Member from the 'members' Database table
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function adminDeleteMemberFromDbAction(Request $request, Application $app, $id)
    {
        $success = Member::delete($id);

        if ($success) {
            $argsArray = [
                'confirmMessage' => 'Member with id ' . $id . ' successfully deleted from the Database!'
            ];
        } else {
            $argsArray = [
                'confirmMessage' => 'Member with id ' . $id . ' could not be deleted from the Database!'
            ];
        }

        $templateName = 'confirmation';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Delete Project from the 'projects' Database table
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function adminDeleteProjectFromDbAction(Request $request, Application $app, $id)
    {
        $success = Project::delete($id);

        if ($success) {
            $argsArray = [
                'confirmMessage' => 'Project with id ' . $id . ' successfully deleted from the Database!'
            ];
        } else {
            $argsArray = [
                'confirmMessage' => 'Project with id ' . $id . ' could not be deleted from the Database!'
            ];
        }

        $templateName = 'confirmation';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Delete Publication from the 'publications' Database table
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function adminDeletePublicationFromDbAction(Request $request, Application $app, $id)
    {
        $success = Publication::delete($id);

        if ($success) {
            $argsArray = [
                'confirmMessage' => 'Publication with id ' . $id . ' successfully deleted from the Database!'
            ];
        } else {
            $argsArray = [
                'confirmMessage' => 'Publication with id ' . $id . ' could not be deleted form the Database!'
            ];
        }

        $templateName = 'confirmation';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    //*********************************************
    //************ ADMIN EDIT ACTIONS *************
    //*********************************************
    /**
     * Redirect Admin to the 'admin edit' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminEditAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $argsArray = [
            'userSession' => $localUser
        ];

        $templateName = 'adminEdit';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'admin edit student' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminEditStudentAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $students = Student::getAll();

        $argsArray = [
            'students' => $students,
            'userSession' => $localUser
        ];

        $templateName = 'adminEditStudent';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'admin edit member' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminEditMemberAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $members = Member::getAll();

        $argsArray = [
            'members' => $members,
            'userSession' => $localUser
        ];

        $templateName = 'adminEditMember';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'admin edit project' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminEditProjectAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $projects = Project::getAll();

        $argsArray = [
            'projects' => $projects,
            'userSession' => $localUser
        ];

        $templateName = 'adminEditProject';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'admin edit publication' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminEditPublicationAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $publications = Publication::getAll();

        $argsArray = [
            'publications' => $publications,
            'userSession' => $localUser
        ];

        $templateName = 'adminEditPublication';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'admin edit student form' page
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function adminEditStudentFormAction(Request $request, Application $app, $id)
    {
        $student = Student::getOneById($id);

        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $argsArray = [
            'student' => $student,
            'userSession' => $localUser
        ];

        $templateName = 'adminEditStudentForm';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'admin edit member form' page
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function adminEditMemberFormAction(Request $request, Application $app, $id)
    {
        $member = Member::getOneById($id);

        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $argsArray = [
            'member' => $member,
            'userSession' => $localUser
        ];

        $templateName = 'adminEditMemberForm';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'admin edit project form' page
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function adminEditProjectFormAction(Request $request, Application $app, $id)
    {
        $project = Project::getOneById($id);

        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $argsArray = [
            'project' => $project,
            'userSession' => $localUser
        ];

        $templateName = 'adminEditProjectForm';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'admin edit publication form' page
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function adminEditPublicationFormAction(Request $request, Application $app, $id)
    {
        $publication = Publication::getOneById($id);

        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $argsArray = [
            'publication' => $publication,
            'userSession' => $localUser
        ];

        $templateName = 'adminEditPublicationForm';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Edit Student and store her/his in the Database
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminEditStudentFromDbAction(Request $request, Application $app)
    {
        // Get data from the input fields
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $studentName = filter_input(INPUT_POST, 'studentName', FILTER_SANITIZE_STRING);
        $studentSurname = filter_input(INPUT_POST, 'studentSurname', FILTER_SANITIZE_STRING);
        $projectId = filter_input(INPUT_POST, 'projectId', FILTER_SANITIZE_NUMBER_INT);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $memberId = filter_input(INPUT_POST, 'memberId', FILTER_SANITIZE_NUMBER_INT);

        // Create the new Student and update her/his data
        $newStudent = new Student();
        $newStudent->setId($id);
        $newStudent->setStudentName($studentName);
        $newStudent->setStudentSurname($studentSurname);
        $newStudent->setProjectId($projectId);
        $newStudent->setEmail($email);
        $newStudent->setMemberId($memberId);

        //var_dump($newStudent);
        //die();

        // Update Student's data
        $studentUpdatedSuccess = Student::update($newStudent);

        if ($studentUpdatedSuccess) {
            $argsArray = [
                'confirmMessage' => 'Student successfully edited and stored in the Database!'
            ];
        } else {
            $argsArray = [
                'confirmMessage' => 'Student could not be edited and stored in the Database!'
            ];
        }

        $templateName = 'confirmation';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Edit Member and store her/his in the Database
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminEditMemberFromDbAction(Request $request, Application $app)
    {
        // Get data from the input fields
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $memberName = filter_input(INPUT_POST, 'memberName', FILTER_SANITIZE_STRING);
        $memberSurname = filter_input(INPUT_POST, 'memberSurname', FILTER_SANITIZE_STRING);
        $projectId = filter_input(INPUT_POST, 'projectId', FILTER_SANITIZE_NUMBER_INT);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $memberStatus = filter_input(INPUT_POST, 'memberStatus', FILTER_SANITIZE_STRING);

        // Create the new Member and update her/his data
        $newMember = new Member();
        $newMember->setId($id);
        $newMember->setMemberName($memberName);
        $newMember->setMemberSurname($memberSurname);
        $newMember->setProjectId($projectId);
        $newMember->setEmail($email);
        $newMember->setMemberStatus($memberStatus);

        // Update Member's data
        $memberUpdatedSuccess = Member::update($newMember);

        if ($memberUpdatedSuccess) {
            $argsArray = [
                'confirmMessage' => 'Student successfully edited and stored in the Database!'
            ];
        } else {
            $argsArray = [
                'confirmMessage' => 'Student could not be edited and stored in the Database!'
            ];
        }

        $templateName = 'confirmation';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Edit Publication and store her/his in the Database
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminEditPublicationFromDbAction(Request $request, Application $app)
    {
        // Get data from the input fields
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $authorId = filter_input(INPUT_POST, 'authorId', FILTER_SANITIZE_NUMBER_INT);
        $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_STRING);
        $datePublished = filter_input(INPUT_POST, 'datePublished', FILTER_SANITIZE_STRING);

        // Create the new Publication and update its data
        $newPublication = new Publication();
        $newPublication->setId($id);
        $newPublication->setTitle($title);
        $newPublication->setAuthorId($authorId);
        $newPublication->setUrl($url);
        $newPublication->setDatePublished($datePublished);

        // Update publication's data
        $publicationUpdatedSuccess = Publication::update($newPublication);

        if ($publicationUpdatedSuccess) {
            $argsArray = [
                'confirmMessage' => 'Student successfully edited and stored in the Database!'
            ];
        } else {
            $argsArray = [
                'confirmMessage' => 'Student could not be edited and stored in the Database!'
            ];
        }

        $templateName = 'confirmation';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Edit Project and store her/his in the Database
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminEditProjectFromDbAction(Request $request, Application $app)
    {
        // Get data from the input fields
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $projectName = filter_input(INPUT_POST, 'projectName', FILTER_SANITIZE_STRING);
        $projectTitle = filter_input(INPUT_POST, 'projectTitle', FILTER_SANITIZE_STRING);
        $projectSupervisor = filter_input(INPUT_POST, 'projectSupervisor', FILTER_SANITIZE_STRING);
        $projectStatus = filter_input(INPUT_POST, 'projectStatus', FILTER_SANITIZE_STRING);

        // Create the new Member and update her/his data
        $newProject = new Project();
        $newProject->setId($id);
        $newProject->setProjectName($projectName);
        $newProject->setProjectTitle($projectTitle);
        $newProject->setProjectSupervisor($projectSupervisor);
        $newProject->setProjectStatus($projectStatus);

        // Update project's data
        $projectUpdatedSuccess = Project::update($newProject);

        if ($projectUpdatedSuccess) {
            $argsArray = [
                'confirmMessage' => 'Student successfully edited and stored in the Database!'
            ];
        } else {
            $argsArray = [
                'confirmMessage' => 'Student could not be edited and stored in the Database!'
            ];
        }

        $templateName = 'confirmation';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    //*********************************************
    //************ ADMIN READ ACTIONS *************
    //*********************************************
    /**
     * Redirect Admin to the 'admin read' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminReadAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $argsArray = [
            'userSession' => $localUser
        ];

        $templateName = 'adminRead';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'read login user' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminReadLoginUserAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $logins = Login::getAll();

        $argsArray = [
            'logins' => $logins,
            'userSession' => $localUser
        ];

        $templateName = 'adminReadLoginUser';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'admin read student' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminReadStudentAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $students = Student::getAll();

        $argsArray = [
            'students' => $students,
            'userSession' => $localUser
        ];

        $templateName = 'adminReadStudent';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'admin read member' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminReadMemberAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $members = Member::getAll();

        $argsArray = [
            'members' => $members,
            'userSession' => $localUser
        ];

        $templateName = 'adminReadMember';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'admin read project' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminReadProjectAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $projects = Project::getAll();

        $argsArray = [
            'projects' => $projects,
            'userSession' => $localUser
        ];

        $templateName = 'adminReadProject';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Admin to the 'admin read publication' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function adminReadPublicationAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $publications = Publication::getAll();

        $argsArray = [
            'publications' => $publications,
            'userSession' => $localUser
        ];

        $templateName = 'adminReadPublication';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }
}
