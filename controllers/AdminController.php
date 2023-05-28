<?php

namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\models\Module;
use app\models\User;
use app\core\Request;
use app\core\Response;

use Exception;

class AdminController extends Controller
{
    public function dashboard()
    {
        return $this->render('admin_dashboard');
    }
    public function courses()
    {
        return $this->render('admin_courses');
    }

    public function veiwAllCourses()
    {
        return $this->render('view_courses');
    }
    public function viewStudents()
    {
        // Retrieve only students from the database
        $usersData = User::findByType('Student');

        $users = [];

        foreach ($usersData as $userData) {
            $user = new User();
            $user->id = $userData['id'];
            // Set other user properties as needed
            $user->username = $userData['username'];
            $user->firstname = $userData['firstname'];
            $user->lastname = $userData['lastname'];
            $user->email = $userData['email'];
            $user->level_id = $userData['level_id'];

            $users[] = $user;
        }

        // Render the view and pass the users data
        return $this->render('view_students', ['users' => $users]);
    }

    public function viewTeachers()
    {
        $usersData = User::findByType('Teacher');
        $users = [];

        foreach ($usersData as $userData) {
            $user = new User();
            $user->id = $userData['id'];
            // Set other user properties as needed
            $user->username = $userData['username'];
            $user->firstname = $userData['firstname'];
            $user->lastname = $userData['lastname'];
            $user->email = $userData['email'];

            $users[] = $user;
        }

        // Render the view and pass the users data
        return $this->render('view_teachers', ['users' => $users]);
    }
    public function addNewCourse(Request $request)
    {
        $module = new Module();

        if ($request->isPost()) {
            $requestData = $request->getBody();

            $module->loadData($requestData);

            if ($module->validate() && $module->save()) {
                $moduleId = Application::$app->db->getLastInsertId();

                $instructorId = $requestData['instructor'];

                $teacherController = new TeacherController();
                $teacherController->enroll($instructorId, $moduleId);

                Application::$app->response->redirect('/admin/courses');
                exit;
            }
        }
        return $this->render('add_new_course', [
            'model' => $module
        ]);
    }

    public function updateCourse(Request $request)
    {
        $module = new Module();

        if ($request->isPost()) {
            $courseCode = $request->getBody()['course_code'] ?? null;

            if ($courseCode) {
                $course = Module::findOne(['course_code' => $courseCode]);

                if ($course) {
                    $course->loadData($request->getBody());

                    if ($course->validate() && $course->update()) {
                        Application::$app->response->redirect('/admin/view-all-courses');
                        exit;
                    }
                }
            }
        }

        return $this->render('update_course', [
            'model' => $module,
        ]);
    }



    public function deleteCourse(Request $request)
    {
        if ($request->isPost()) {
            $courseName = $request->getBody()['course_name'] ?? null;

            if ($courseName) {

                $course = Module::findOne(['course_name' => $courseName]);
                var_dump($course);
                if ($course) {
                    if ($course->delete()) {
                        Application::$app->response->redirect('/admin/view-all-courses');
                        exit;
                    }
                }
            }
        }
        return $this->render('delete_course');
    }








    public function createModule()
    {
        // Logic to create a new module

        // Redirect or render a response
    }

    public function gradeTask()
    {
        // Logic to grade a task submitted by a student

        // Redirect or render a response
    }

    public function createQuiz()
    {
        // Logic to create a new quiz

        // Redirect or render a response
    }

    public function gradeQuiz()
    {
        // Logic to grade a quiz taken by a student

        // Redirect or render a response
    }
    public function removeUser(Request $request): array|bool|string
    {
        if ($request->isPost()) {
            // Retrieve the user ID from the POST data
            $userId = $request->getBody()['id'];

            // Create an instance of the User model and find the user by ID
            $user = User::findOne(['id' => $userId]);

            if ($user) {
                $user->delete();
                Application::$app->response->redirect('/viewUsers');
                exit;
            }
        }
        return $this->render('removeUser');
    }

    public function manageUsers()
    {
        // Logic to manage users (students, teachers, admins)

        // Redirect or render a response
    }

    public function viewAllUsers(Request $request, Response $response): array|bool|string
    {
        // Retrieve all users from the database
        $usersData = User::findAll();
        $users = [];

        foreach ($usersData as $userData) {
            $user = new User();
            $user->id = $userData['id'];
            // Set other user properties as needed
            $user->username = $userData['username'];
            $user->firstname = $userData['firstname'];
            $user->lastname = $userData['lastname'];
            $user->email = $userData['email'];

            $users[] = $user;
        }

        // Render the view and pass the users data
        return $this->render('view_users', ['users' => $users]);
    }
    public function editUser(Request $request, Response $response)
    {
        $id = $request->getQueryParam('id');

        // Fetch the user from the database based on the ID
        $user = User::findOne(['id' => $id]);

        if (!$user) {
            // User not found, handle the error or redirect as needed
            // For example:
            $response->redirect('/admin/dashboard');
            return;
        }

        // Handle the edit user form submission
        if ($request->isPost()) {
            // Load the user data from the request
            $user->loadData($request->getBody());

            // Validate and save the user data
            if ($user->validate() && $user->save()) {
                // User updated successfully, handle the success or redirect as needed
                // For example:
                $response->redirect('/admin/dashboard');
                return;
            }
        }

        // Render the edit user form
        return $this->render('edit_user', [
            'user' => $user,
        ]);
    }

//    public function removeUser(Request $request, Response $response)
//    {
//        // Get the user ID from the request
//        $id = $request->getBodyParam('id');
//
//        // Fetch the user from the database based on the ID
//        $user = User::findOne(['id' => $id]);
//
//        if (!$user) {
//            // User not found, handle the error or redirect as needed
//            // For example:
//            $response->redirect('/admin/dashboard');
//            return;
//        }
//
//        // Delete the user from the database
//        if ($user->delete()) {
//            // User removed successfully, handle the success or redirect as needed
//            // For example:
//            $response->redirect('/admin/dashboard');
//            return;
//        } else {
//            // Failed to remove the user, handle the error or redirect as needed
//            // For example:
//            $response->redirect('/admin/dashboard');
//            return;
//        }
//    }

}
