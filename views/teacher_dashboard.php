<?php
/** @var $this View */

use app\core\Application;
use app\core\View;

$this->title = Application::$app->user->getDisplayName().' '.'dashboard';
?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>CodePen - Tailwind CSS Task Manager Dashboard UI</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css'><link rel="stylesheet" href="./style.css">

</head>

<body>
<!-- partial:index.partial.html -->
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
                        <a href="javascript:void(0)" class="flex items-center rounded-xl font-bold text-sm text-yellow-900 py-3 px-4" style="color: #fff; background-color: #1B1947">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="#FFF" class="text-lg mr-4" viewBox="0 0 16 16">
                                <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                            </svg><?php echo Application::$app->user->getDisplayName()?> Dashboard
                        </a>
                    </li>

                    <li>
                        <a href="/teacher/courses" class="flex bg-white hover:bg-yellow-100 rounded-xl font-bold text-sm text-gray-900 py-3 px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="text-lg mr-4" viewBox="0 0 16 16">
                                <path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
                            </svg>Courses
                        </a>
                    </li>
                    <li>
                        <a href="/teacher/assignments" class="flex bg-white hover:bg-yellow-100 rounded-xl font-bold text-sm text-gray-900 py-3 px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="text-lg mr-4" viewBox="0 0 16 16">
                                <path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
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

<main class="ml-60 pt-16 max-h-screen overflow-auto flex justify-center items-center">
    <div class="w-10/10">
        <div class="px-6 py-8">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-3xl p-8 mb-5">



                    <div class="grid grid-cols-2 gap-x-20">
                        <div>
                            <h2 class="text-2xl font-bold mb-4">Stats</h2>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-2">
                                    <div class="p-4 bg-green-100 rounded-xl">
                                        <div class="font-bold text-xl text-gray-800 leading-none">Good day, <?php echo Application::$app->user->getDisplayName()?></div>
                                        <div class="mt-5">
                                            <button type="button" class="inline-flex items-center justify-center py-2 px-3 rounded-xl bg-white text-gray-800 hover:text-green-500 text-sm font-semibold transition">
                                                Start tracking
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 bg-yellow-100 rounded-xl text-gray-800">
                                    <div class="font-bold text-2xl leading-none"><?php echo Application::$app->user->getUserCoursesNumber(Application::$app->user->getUserID())?></div>
                                    <div class="mt-2"><?php echo Application::$app->user->getDisplayName()?>'s Courses</div>
                                    <a href="/teacher/courses/enrolled">
                                        <button type="button" class="inline-flex items-center justify-center py-2 px-3 rounded-xl bg-white text-gray-800 hover:text-yellow-500 text-sm font-semibold transition">
                                           View
                                        </button>
                                    </a>
                                </div>
                                <div class="p-4 bg-yellow-100 rounded-xl text-gray-800">
                                    <div class="font-bold text-2xl leading-none">5,5</div>
                                    <div class="mt-2">Tracked hours</div>
                                </div>
                                <div class="col-span-2">
                                    <div class="p-4 bg-purple-100 rounded-xl text-gray-800">
                                        <div class="font-bold text-xl leading-none">Your daily plan</div>
                                        <div class="mt-2">5 of 8 completed</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold mb-4">Your tasks today</h2>

                            <div class="space-y-4">
                                <div class="p-4 bg-white border rounded-xl text-gray-800 space-y-2">
                                    <div class="flex justify-between">
                                        <div class="text-gray-400 text-xs">Number 10</div>
                                        <div class="text-gray-400 text-xs">4h</div>
                                    </div>
                                    <a href="javascript:void(0)" class="font-bold hover:text-yellow-800 hover:underline">Blog and social posts</a>
                                    <div class="text-sm text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="text-gray-800 inline align-middle mr-1" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                        </svg>Deadline is today
                                    </div>
                                </div>
                                <div class="p-4 bg-white border rounded-xl text-gray-800 space-y-2">
                                    <div class="flex justify-between">
                                        <div class="text-gray-400 text-xs">Grace Aroma</div>
                                        <div class="text-gray-400 text-xs">7d</div>
                                    </div>
                                    <a href="javascript:void(0)" class="font-bold hover:text-yellow-800 hover:underline">New campaign review</a>
                                    <div class="text-sm text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="text-gray-800 inline align-middle mr-1" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                        </svg>New feedback
                                    </div>
                                </div>
                                <div class="p-4 bg-white border rounded-xl text-gray-800 space-y-2">
                                    <div class="flex justify-between">
                                        <div class="text-gray-400 text-xs">Petz App</div>
                                        <div class="text-gray-400 text-xs">2h</div>
                                    </div>
                                    <a href="javascript:void(0)" class="font-bold hover:text-yellow-800 hover:underline">Cross-platform and browser QA</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
<!-- partial -->

</body>
</html>
