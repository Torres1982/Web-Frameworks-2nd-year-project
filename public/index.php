<?php

// Basic setup
require_once __DIR__ . '/../app/setup.php';

use Itb\Utility\Utility;

// Navigation Bar Controllers
$app->get('/', Utility::controller('Itb\Controller', 'main/index'));
$app->get('/index', Utility::controller('Itb\Controller', 'main/index'));
$app->get('/publications', Utility::controller('Itb\Controller', 'publication/publications'));
$app->get('/projects', Utility::controller('Itb\Controller', 'project/projects'));
$app->get('/members', Utility::controller('Itb\Controller', 'member/members'));
$app->get('/students', Utility::controller('Itb\Controller', 'student/students'));

// Login and Logout Controllers
$app->post('/processLogin', Utility::controller('Itb\Controller', 'login/processLogin'));
$app->get('/logout', Utility::controller('Itb\Controller', 'login/logout'));

// Admin Controllers
$app->get('/adminIndex', Utility::controller('Itb\Controller', 'admin/adminIndex'));

$app->get('/adminCreate', Utility::controller('Itb\Controller', 'admin/adminCreate'));
$app->get('/adminCreateLoginUser', Utility::controller('Itb\Controller', 'admin/adminCreateLoginUser'));
$app->post('/adminInsertLoginUserIntoDb', Utility::controller('Itb\Controller', 'admin/adminInsertLoginUserIntoDb'));
$app->get('/adminCreateStudent', Utility::controller('Itb\Controller', 'admin/adminCreateStudent'));
$app->post('/adminInsertStudentIntoDb', Utility::controller('Itb\Controller', 'admin/adminInsertStudentIntoDb'));
$app->get('/adminCreateMember', Utility::controller('Itb\Controller', 'admin/adminCreateMember'));
$app->post('/adminInsertMemberIntoDb', Utility::controller('Itb\Controller', 'admin/adminInsertMemberIntoDb'));
$app->get('/adminCreateProject', Utility::controller('Itb\Controller', 'admin/adminCreateProject'));
$app->post('/adminInsertProjectIntoDb', Utility::controller('Itb\Controller', 'admin/adminInsertProjectIntoDb'));
$app->get('/adminCreatePublication', Utility::controller('Itb\Controller', 'admin/adminCreatePublication'));
$app->post('/adminInsertPublicationIntoDb', Utility::controller('Itb\Controller', 'admin/adminInsertPublicationIntoDb'));

$app->get('/adminDelete', Utility::controller('Itb\Controller', 'admin/adminDelete'));
$app->get('/adminDeleteLoginUser', Utility::controller('Itb\Controller', 'admin/adminDeleteLoginUser'));
$app->get('/adminDeleteLoginUserFromDb/{id}', Utility::controller('Itb\Controller', 'admin/adminDeleteLoginUserFromDb'));
$app->get('/adminDeleteStudent', Utility::controller('Itb\Controller', 'admin/adminDeleteStudent'));
$app->get('/adminDeleteStudentFromDb/{id}', Utility::controller('Itb\Controller', 'admin/adminDeleteStudentFromDb'));
$app->get('/adminDeleteMember', Utility::controller('Itb\Controller', 'admin/adminDeleteMember'));
$app->get('/adminDeleteMemberFromDb/{id}', Utility::controller('Itb\Controller', 'admin/adminDeleteMemberFromDb'));
$app->get('/adminDeleteProject', Utility::controller('Itb\Controller', 'admin/adminDeleteProject'));
$app->get('/adminDeleteProjectFromDb/{id}', Utility::controller('Itb\Controller', 'admin/adminDeleteProjectFromDb'));
$app->get('/adminDeletePublication', Utility::controller('Itb\Controller', 'admin/adminDeletePublication'));
$app->get('/adminDeletePublicationFromDb/{id}', Utility::controller('Itb\Controller', 'admin/adminDeletePublicationFromDb'));

$app->get('/adminEdit', Utility::controller('Itb\Controller', 'admin/adminEdit'));
$app->get('/adminEditLoginUser', Utility::controller('Itb\Controller', 'admin/adminEditLoginUser'));
$app->get('/adminEditLoginUserForm/{id}', Utility::controller('Itb\Controller', 'admin/adminEditLoginUserForm'));
$app->get('/adminEditLoginUserForm/', Utility::controller('Itb\Controller', 'admin/adminEditLoginUserFormMissingId'));
$app->post('/adminEditLoginUserFromDb', Utility::controller('Itb\Controller', 'admin/adminEditLoginUserFromDb'));
$app->get('/adminEditStudent', Utility::controller('Itb\Controller', 'admin/adminEditStudent'));
$app->get('/adminEditStudentForm/{id}', Utility::controller('Itb\Controller', 'admin/adminEditStudentForm'));
$app->get('/adminEditStudentForm/', Utility::controller('Itb\Controller', 'admin/adminEditStudentFormMissingId'));
$app->post('/adminEditStudentFromDb', Utility::controller('Itb\Controller', 'admin/adminEditStudentFromDb'));
$app->get('/adminEditMember', Utility::controller('Itb\Controller', 'admin/adminEditMember'));
$app->get('/adminEditMemberForm/{id}', Utility::controller('Itb\Controller', 'admin/adminEditMemberForm'));
$app->get('/adminEditMemberForm/', Utility::controller('Itb\Controller', 'admin/adminEditMemberFormMissingId'));
$app->post('/adminEditMemberFromDb', Utility::controller('Itb\Controller', 'admin/adminEditMemberFromDb'));
$app->get('/adminEditProject', Utility::controller('Itb\Controller', 'admin/adminEditProject'));
$app->get('/adminEditProjectForm/{id}', Utility::controller('Itb\Controller', 'admin/adminEditProjectForm'));
$app->get('/adminEditProjectForm/', Utility::controller('Itb\Controller', 'admin/adminEditProjectFormMissingId'));
$app->post('/adminEditProjectFromDb', Utility::controller('Itb\Controller', 'admin/adminEditProjectFromDb'));
$app->get('/adminEditPublication', Utility::controller('Itb\Controller', 'admin/adminEditPublication'));
$app->get('/adminEditPublicationForm/{id}', Utility::controller('Itb\Controller', 'admin/adminEditPublicationForm'));
$app->get('/adminEditPublicationForm/', Utility::controller('Itb\Controller', 'admin/adminEditPublicationFormMissingId'));
$app->post('/adminEditPublicationFromDb', Utility::controller('Itb\Controller', 'admin/adminEditPublicationFromDb'));

$app->get('/adminRead', Utility::controller('Itb\Controller', 'admin/adminRead'));
$app->get('/adminReadLoginUser', Utility::controller('Itb\Controller', 'admin/adminReadLoginUser'));
$app->get('/adminReadStudent', Utility::controller('Itb\Controller', 'admin/adminReadStudent'));
$app->get('/adminReadMember', Utility::controller('Itb\Controller', 'admin/adminReadMember'));
$app->get('/adminReadProject', Utility::controller('Itb\Controller', 'admin/adminReadProject'));
$app->get('/adminReadPublication', Utility::controller('Itb\Controller', 'admin/adminReadPublication'));

// Student Controllers
$app->get('/studentIndex', Utility::controller('Itb\Controller', 'student/studentIndex'));
$app->get('/studentEditForm/{id}', Utility::controller('Itb\Controller', 'student/studentEditForm'));
$app->get('/studentEditForm/', Utility::controller('Itb\Controller', 'student/studentEditFormMissingId'));
$app->post('/studentEditFromDb', Utility::controller('Itb\Controller', 'student/studentEditFromDb'));
$app->post('/studentUploadPhoto', Utility::controller('Itb\Controller', 'student/studentUploadPhoto'));
$app->get('/showOneStudent/{id}', Utility::controller('Itb\Controller', 'student/showOneStudent'));
$app->get('/showOneStudent/', Utility::controller('Itb\Controller', 'student/showOneStudentMissingId'));

// Member Controllers
$app->get('/memberIndex', Utility::controller('Itb\Controller', 'member/memberIndex'));
$app->get('/showCurrentMembers', Utility::controller('Itb\Controller', 'member/showCurrentMembers'));
$app->get('/showPastMembers', Utility::controller('Itb\Controller', 'member/showPastMembers'));

// Project Controllers
$app->get('/showCurrentProjects', Utility::controller('Itb\Controller', 'project/showCurrentProjects'));
$app->get('/showPastProjects', Utility::controller('Itb\Controller', 'project/showPastProjects'));

// Error 404 - Page not found
$app->error(function (\Exception $e, $code) use ($app) {
    switch ($code) {
        case 404:
            $message = 'The requested page cannot be located.';
            return \Itb\Controller\MainController::error404($app, $message);

        default:
            $message = 'Sorry, but some errors have occurred.';
            return \Itb\Controller\MainController::error404($app, $message);
    }
});

// Run Silex
$app->run();
