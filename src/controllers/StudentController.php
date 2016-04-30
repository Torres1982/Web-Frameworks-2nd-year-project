<?php
/**
 * Created by B00073668
 * @author - Artur Sukiennik
 * @since - 2016
 */
namespace Itb\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Itb\Model\Student;

/**
 * Class StudentController - manages 'students' actions
 * @package Itb\Controller
 */
class StudentController
{
    /**
     * Get students details from Database
     * @param Request $request
     * @param Application $app
     * @return array
     */
    public function studentsAction(Request $request, Application $app)
    {
        $students = Student::getAll();

        $appArgs = [
          'students' => $students,
        ];

        $templateName = 'students';
        return $app['twig']->render($templateName . '.html.twig', $appArgs);
    }

    /**
     * Redirect Student to the 'index' page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function studentIndexAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];
        //var_dump($localUser);

        // Get ID for the user currently logged in ($localUser)
        $student = Student::getStudentByUsername($localUser);
        $id = $student->getId();
        //var_dump($id);

        // Get all information for the currently logged in user (1 row)
        $studentRecord = Student::getOneById($id);

        $argsArray = [
            'student' => $studentRecord,
            'userSession' => $localUser
        ];

        $templateName = 'studentIndex';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Redirect Student to the 'student edit form' page
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function studentEditFormAction(Request $request, Application $app, $id)
    {
        $student = Student::getOneById($id);

        $user = $app['session']->get('user');
        $localUser = $user['username'];

        $argsArray = [
            'student' => $student,
            'userSession' => $localUser
        ];

        $templateName = 'studentEditForm';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Update Student details (surname and email address)
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function studentEditFromDbAction(Request $request, Application $app)
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

        // Create a new instance of Student and update her/his data
        $studentUpdatedSuccess = Student::update($newStudent);

        if ($studentUpdatedSuccess) {
            $argsArray = [
                'confirmMessage' => 'You successfully edited and stored your details in the Database!'
            ];
        } else {
            $argsArray = [
                'confirmMessage' => 'Your details could not be edited and stored in the Database!'
            ];
        }

        $templateName = 'confirmationStudent';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    public function studentUploadPhotoAction(Request $request, Application $app)
    {
        $user = $app['session']->get('user');
        $localUser = $user['username'];

        // Get ID for the user currently logged in ($localUser)
        $student = Student::getStudentByUsername($localUser);
        $id = $student->getId();

        // Get all information for the currently logged in user (1 row)
        $studentRecord = Student::getOneById($id);

        // Path to where uploaded pictures will be stored
        $target_path = "uploads/";
        $target_path = $target_path . basename($_FILES['uploadedImage']['name']);
        $profileImage = basename($_FILES['uploadedImage']['name']);

        // The path to temporary file and path to where the file will be stored must be provided
        if (move_uploaded_file($_FILES['uploadedImage']['tmp_name'], $target_path)) {
            echo "The image " . $profileImage . " has been uploaded";
        } else {
            echo "Error! Image has not been uploaded!";
        }

        $argsArray = [
            'profileImage' => $profileImage,
            'student' => $studentRecord,
            'userSession' => $localUser
        ];

        $templateName = 'studentIndex';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Show a single Student details page
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function showOneStudentAction(Request $request, Application $app, $id)
    {
        //reference to the repository
        $student = Student::getOneById($id);

        // Error message
        $confirmMessage = 'Sorry, no student with id ' . $id . ' could be found!';

        $argsArray = [
            'confirmMessage' => $confirmMessage
        ];

        $templateName = 'errorMessage';

        // If the Student is found, show her/his details
        if (null != $student) {
            $argsArray = [
                'student' => $student
            ];

            $templateName = 'showOneStudent';
        }

        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Display error message if no Student ID is found
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function showOneStudentMissingIdAction(Request $request, Application $app)
    {
        $confirmMessage = 'The Student ID is missing!';

        $argsArray = [
            'confirmMessage' => $confirmMessage
        ];

        $templateName = 'errorMessageStudent';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }
}
