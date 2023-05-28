<?php

use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;
use app\controllers\StudentController;
use app\controllers\TeacherController;
use app\controllers\AdminController;
use app\models\Admin;
use app\models\Module;
use app\models\Quiz;
use app\models\Student;
use app\models\Teacher;
use app\core\ModelFactory;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config);

//$app->router->get('/', [AuthController::class, 'login']);

$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'contact']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->router->get('/logout', [AuthController::class, 'logout']);

$app->router->get('/profile', [AuthController::class, 'profile']);

// Student routes
$app->router->get('/student/submit-task', [StudentController::class, 'submitTask']);
$app->router->post('/student/submit-task', [StudentController::class, 'submitTask']);
$app->router->get('/student/take-quiz', [StudentController::class, 'takeQuiz']);
$app->router->post('/student/take-quiz', [StudentController::class, 'takeQuiz']);
$app->router->get('/student/dashboard', [StudentController::class, 'dashboard']);
$app->router->get('/student/enroll-course', [StudentController::class, 'enroll']);
$app->router->post('/student/enroll-course', [StudentController::class, 'enroll']);
$app->router->get('/student/courses/enrolled', [StudentController::class, 'enrolled_courses_page']);
$app->router->get('/student/courses', [StudentController::class, 'student_courses_page']);
$app->router->get('/student/assignments', [StudentController::class, 'student_view_assignments']);
$app->router->get('/student/submit-assignment', [StudentController::class, 'submit']);
$app->router->post('/student/submit-assignment', [StudentController::class, 'submit']);


// Teacher routes
$app->router->get('/teacher/dashboard', [TeacherController::class, 'dashboard']);
$app->router->get('/teacher/enroll-course', [TeacherController::class, 'enroll']);
$app->router->post('/teacher/enroll-course', [TeacherController::class, 'enroll']);
$app->router->get('/teacher/courses', [TeacherController::class, 'teacher_courses_page']);
$app->router->get('/teacher/courses/enrolled', [TeacherController::class, 'enrolled_courses_page']);
$app->router->get('/teacher/assignments/create-assignment', [TeacherController::class, 'createAssignment']);
$app->router->post('/teacher/assignments/create-assignment', [TeacherController::class, 'createAssignment']);
$app->router->get('/teacher/assignments', [TeacherController::class, 'view_assignments']);



// Admin routes
$app->router->get('/admin/dashboard', [AdminController::class, 'dashboard']);
//$app->router->get('/admin/dashboard', [AdminController::class, 'viewAllUsers']);
$app->router->get('/admin/edit-user', [AdminController::class, 'update']);
$app->router->post('/admin/edit-user', [AdminController::class, 'update']);
$app->router->post('/admin/remove-user', [AdminController::class, 'removeUser']);

$app->router->get('/admin/view-users', [AdminController::class, 'viewAllUsers']);
$app->router->get('/admin/view-users/students', [AdminController::class, 'viewStudents']);
$app->router->get('/admin/view-users/teachers', [AdminController::class, 'viewTeachers']);
$app->router->post('/admin/view-users', [AdminController::class, 'removeUser']);
$app->router->post('/admin/removeUser', [AdminController::class, 'removeUser']);

$app->router->get('/admin/courses', [AdminController::class, 'courses']);

$app->router->get('/admin/new-course', [AdminController::class, 'addNewCourse']);
$app->router->post('/admin/new-course', [AdminController::class, 'addNewCourse']);

$app->router->get('/admin/update-course', [AdminController::class, 'updateCourse']);
$app->router->post('/admin/update-course', [AdminController::class, 'updateCourse']);

$app->router->get('/admin/delete-course', [AdminController::class, 'deleteCourse']);
$app->router->post('/admin/delete-course', [AdminController::class, 'deleteCourse']);

$app->router->get('/admin/view-all-courses', [AdminController::class, 'veiwAllCourses']);
$app->router->post('/admin/view-all-courses', [AdminController::class, 'deleteCourse']);

// For testing Observer design pattern and Factory design pattern
/*
$module = new Module();

$quiz = new Quiz();
$teacher = new Teacher();
$admin = new Admin();
$student = new Student();

$module->attach($teacher);
$module->attach($admin);
$module->attach($student);
$module->attach($quiz);

$module->notify();

// Testing the Factory Design Pattern
$userModel = ModelFactory::createModel('user');
$adminModel = ModelFactory::createModel('admin');
$studentModel = ModelFactory::createModel('student');
$teacherModel = ModelFactory::createModel('teacher');

echo "User Model: " . get_class($userModel) . "\n";
echo "Admin Model: " . get_class($adminModel) . "\n";
echo "Student Model: " . get_class($studentModel) . "\n";
echo "Teacher Model: " . get_class($teacherModel) . "\n";
*/

$app->run();
