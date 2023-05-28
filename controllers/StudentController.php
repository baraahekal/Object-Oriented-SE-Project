<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Assignment;
use app\models\AssignmentSubmission;
use app\models\Module;
use app\models\User;

class StudentController extends Controller
{
    public function dashboard()
    {
        return $this->render('student_dashboard');
    }
    public function student_view_assignments()
    {
        return $this->render('student_view_assignments');
    }
    public function courses()
    {
        return $this->render('student_courses');
    }
    public function student_courses_page()
    {
        return $this->render('student_courses');
    }
    public function enrolled_courses_page()
    {
        return $this->render('student_enrolled_courses');
    }
    public function submit(Request $request)
    {
        if ($request->isPost()) {
            // Retrieve the assignment ID and student ID
            $assignmentId = (int) ($_GET['assignment_id'] ?? 0);

            $studentId = Application::$app->user->getUserID();

            // Retrieve the submitted file
            $file = $request->getFile('file');


            // Process the file and save the submission
            if ($file !== null && $file['error'] === UPLOAD_ERR_OK) {
                $filePath = '/Applications/XAMPP/xamppfiles/htdocs/LMS/uploaded_files/' . $file['name'];

                if (move_uploaded_file($file['tmp_name'], $filePath)) {
                    // Create an instance of the AssignmentSubmission model
                    $submission = new AssignmentSubmission();
                    $submission->assignment_id = $assignmentId;
                    $submission->student_id = $studentId;
                    $submission->file_path = $filePath;
                    $submission->submitted_at = date('Y-m-d H:i:s');

                    // Save the submission to the database
                    $submission->save();

                    // Redirect the student to a success page
                    Application::$app->response->redirect('/student/assignments');
                }
            }
        }

        // Redirect the student to an error page or display an error message
        return $this->render('student_submit_assignment');
    }


    public function enroll(Request $request)
    {
        if ($request->isPost()) {
            // Retrieve the user ID
            $userId = Application::$app->user->getUserID();


            $selectedCourse = $request->getBody()['course_name'] ?? null;
            $courseId = Module::findOne(['course_name' => $selectedCourse])->id;

            $user = User::findOne(['id' => $userId]);

            if (!$user) {
                // User does not exist, handle the error or return false
                return false;
            } else {

                $enrollmentStatement = self::prepare("INSERT INTO user_courses (user_id, course_id) VALUES (:user_id, :course_id)");
                $enrollmentStatement->bindValue(":user_id", $userId);
                $enrollmentStatement->bindValue(":course_id", $courseId);
                $enrollmentStatement->execute();

                Application::$app->response->redirect('/student/courses');
            }
        }

        return $this->render('enroll_student');
    }
    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }


    public function submitTask()
    {
        // Logic to submit a task by the student

        // Redirect or render a response
    }
    public function takeQuiz()
    {
        // Logic to allow a student to take a quiz

        // Redirect or render a response
    }
}