<?php
/** @var $this View */

use app\core\Application;
use app\core\form\Form;
use app\core\View;
use app\models\Module;

$this->title = 'Users';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CodePen - Tailwind CSS Task Manager Dashboard UI</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css'>
    <link rel="stylesheet" href="./style.css">
</head>

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
                        <a href="/admin/dashboard" class="flex bg-white hover:bg-yellow-100 rounded-xl font-bold text-sm text-gray-900 py-3 px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="#1B1947" class="text-lg mr-4" viewBox="0 0 16 16">
                                <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                            </svg><?php echo Application::$app->user->getDisplayName()?> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="/register" class="flex bg-white hover:bg-yellow-100 rounded-xl font-bold text-sm text-gray-900 py-3 px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="text-lg mr-4" viewBox="0 0 16 16">
                                <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1z"/>
                            </svg>Registration
                        </a>
                    </li>
                    <li>
                        <a href="/admin/courses" class="flex bg-white hover:bg-yellow-100 rounded-xl font-bold text-sm text-gray-900 py-3 px-4">

                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="text-lg mr-4" viewBox="0 0 16 16">
                                <path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
                            </svg>Courses
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center rounded-xl font-bold text-sm text-yellow-900 py-3 px-4" style="color: #fff; background-color: #1B1947">

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-lg mr-4" viewBox="0 0 16 16">
                                <path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1H2zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            </svg>Users
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

<div class="w-full flex justify-center items-center h-screen">
    <main class="ml-60 pt-16 max-h-screen overflow-auto">
        <div class="px-6 py-8">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-3xl p-8 mb-5">
                    <h2 class="text-2xl font-bold mb-4">Stats</h2>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 bg-yellow-100 rounded-xl text-gray-800">
                            <div class="font-bold text-2xl leading-none"><?php echo Application::$app->user->getStudentsNumber()?></div>
                            <div class="mt-2">Students number</div>
                            <a href="/admin/view-users/students" >
                                <button type="button" class="inline-flex items-center justify-center py-2 px-3 mt-3 rounded-xl bg-white text-gray-800 hover:text-yellow-500 text-sm font-semibold transition">
                                    View
                                </button>
                            </a>
                        </div>

                        <div class="p-4 bg-purple-100 rounded-xl text-gray-800">
                            <div class="font-bold text-2xl leading-none"><?php echo Application::$app->user->getTeachersNumber()?></div>
                            <div class="mt-2">Teachers number</div>
                            <a href="/admin/view-users/teachers" >
                                <button type="button" class="inline-flex items-center justify-center py-2 px-3 mt-3 rounded-xl bg-white text-gray-800 hover:text-purple-500 text-sm font-semibold transition">
                                    View
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>



</body>
</html>