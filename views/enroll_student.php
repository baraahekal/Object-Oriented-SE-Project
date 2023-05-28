<?php
/** @var $this View */

use app\core\Application;
use app\core\form\Form;
use app\core\View;
use app\models\Module;

$this->title = 'Enroll User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enroll User in Course</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css'>
    <link rel="stylesheet" href="./style.css">
</head>

<style>
    body {
        background-color: #fff;
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        flex-direction: column;
    }

    .form-container {
        background-color: #1B1947;

        padding-left: 150px;
        border-radius: 10px;
        margin: 0 auto; /* Centers the form horizontally */
        max-width: 600px; /* Adjust the max-width as needed */
    }
    h1 {
        color: #fff;
    }
    .logo {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .form-control {
        border-radius: 5px;
        border: 1px solid #ccc;
        padding: 8px;
        margin-bottom: 10px;
        width: 100%;
        box-sizing: border-box;
        background-color: #fff;
        color: #000;
    }

    .form-label {
        color: #fff;
    }

    .button-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .btn-primary {
        background-color: #B99F69;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>


<body class="relative overflow-hidden max-h-screen" style="background-color: #1B1947;">

<aside class="fixed inset-y-0 left-0 bg-white shadow-md max-h-screen w-60">
    <div class="flex flex-col justify-between h-full">
        <div class="flex-grow">
            <div class="px-4 py-6 text-center border-b">
                <h1 class="text-xl font-bold leading-none"><span class="" style="color: #1B1947;">Welcome, <?php echo Application::$app->user->getDisplayName()?></h1>
            </div>
            <div class="p-4">
                <ul class="space-y-1">
                    <li>
                        <a href="/student/dashboard" class="flex bg-white hover:bg-yellow-100 rounded-xl font-bold text-sm text-gray-900 py-3 px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="#1B1947" class="text-lg mr-4" viewBox="0 0 16 16">
                                <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                            </svg><?php echo Application::$app->user->getDisplayName()?> Dashboard
                        </a>
                    </li>

                    <li>
                        <a href="/student/courses" class="flex items-center rounded-xl font-bold text-sm text-yellow-900 py-3 px-4" style="color: #fff; background-color: #1B1947">

                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="text-lg mr-4" viewBox="0 0 16 16">
                                <path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
                            </svg>Courses
                        </a>
                    </li>
                    <li>
                        <a href="/student/assignments" class="flex bg-white hover:bg-yellow-100 rounded-xl font-bold text-sm text-gray-900 py-3 px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="#1B1947" class="text-lg mr-4" viewBox="0 0 16 16">
                                <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                            </svg>Assignments
                        </a>
                    </li>

                </ul>
            </div>

        </div>
        <div class="p-4">
            <a href="/logout">
                <button type="button" class="inline-flex items-center justify-center h-9 px-4 rounded-xl bg-gray-900 text-gray-300 hover:text-white text-sm font-semibold transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="" viewBox="0 0 16 16">
                        <path d="M12 1a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2a1 1 0 0 1 1-1h8zm-2 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                    </svg>
                </button>
                <span class="font-bold text-sm ml-2"></span>
            </a>

        </div>
    </div>
</aside>

<div class="w-10/10 flex justify-center items-center h-screen">
    <div class="form-container">
        <?php $form = Form::begin('', 'post') ?>

        <div class="row">
            <div class="col">
                <?php
                $selectedCourse = null; // Variable to hold the selected course name

                $module = new Module();
                $allCourses = Application::$app->module->getLevelCourses(Application::$app->user->level_id);

                $enrolledCourses = Application::$app->user->getUserEnrolledCourses();

                // Create an array of enrolled course names
                $enrolledCourseNames = array_column($enrolledCourses, 'course_name');

                // Filter out the enrolled courses from the list of all courses
                $availableCourses = array_filter($allCourses, function ($course) use ($enrolledCourseNames) {
                    return !in_array($course['course_name'], $enrolledCourseNames);
                });

                // Check if the form is submitted and the selected value is available
                if ($module->course_name !== null) {
                    $selectedCourse = $module->course_name;
                }

                // Render the dropdown input field
                echo '<select name="course_name" class="form-control">';
                foreach ($availableCourses as $course) {
                    $selected = ($course['course_name'] === $selectedCourse) ? 'selected' : '';
                    echo '<option value="' . htmlspecialchars($course['course_name']) . '" ' . $selected . '>' . htmlspecialchars($course['course_name']) . '</option>';
                }
                echo '</select>';
                ?>
            </div>
        </div>




        <div class="button-container">
            <button type="submit" class="inline-flex items-center justify-center py-2 px-3 mt-3 rounded-xl bg-white text-gray-800 hover:text-green-500 text-sm font-semibold transition">
                Enroll
            </button>
        </div>

        <?php Form::end() ?>
    </div>
</div>

</body>
</html>
