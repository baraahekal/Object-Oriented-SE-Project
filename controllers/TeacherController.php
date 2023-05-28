<?php

namespace app\controllers;
use app\core\Application;
use app\core\Controller;
use app\core\Model;
use app\core\Request;
use app\models\Assignment;
use app\models\Module;
use app\models\User;

class TeacherController extends Controller
{
    public function dashboard()
    {
        return $this->render('teacher_dashboard');
    }
    public function teacher_courses_page()
    {
        return $this->render('teacher_courses');
    }
    public function view_assignments()
    {
        return $this->render('teacher_view_assignments');
    }
    public function enrolled_courses_page()
    {
        return $this->render('teacher_enrolled_courses');
    }


    public function createAssignment(Request $request)
    {
        if ($request->isPost()) {
            $assignment = new Assignment();
            $assignment->loadData($request->getBody());

            $courseName = $request->getBody()['course_name'];
            $course = Module::findOne(['course_name' => $courseName]);

            $assignment->course_id = $course->id;

            $file = $_FILES['file'] ?? null;

            if ($file !== null && $file['error'] === UPLOAD_ERR_OK) {
                $fileName = $file['name'];
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $newFileName = uniqid() . '.' . $fileExtension;
                $filePath = '/Applications/XAMPP/xamppfiles/htdocs/LMS/uploaded_files/' . $newFileName;

                if (move_uploaded_file($file['tmp_name'], $filePath)) {
                    $assignment->file_path = $filePath;
                }
            }

            if ($assignment->save()) {
                Application::$app->response->redirect('/teacher/assignments');
                exit;
            }
        }

        return $this->render('teacher_create_assignments');
    }




    public function enroll($instructorId, $moduleId)
    {
        $userId = $instructorId;

        if (!$userId) {
            // User ID not available, handle the error or return false
            return false;
        }

        // Insert enrollment into the user_courses table
        $enrollmentStatement = self::prepare("INSERT INTO user_courses (user_id, course_id) VALUES (:user_id, :course_id)");
        $enrollmentStatement->bindValue(":user_id", $userId);
        $enrollmentStatement->bindValue(":course_id", $moduleId);
        $enrollmentStatement->execute();

        // Perform any additional logic or redirect as needed

        return true;
    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
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
}
