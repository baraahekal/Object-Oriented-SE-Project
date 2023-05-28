<?php
/** @var $this View */

use app\core\Application;
use app\core\form\Form;
use app\core\View;
use app\models\Module;

$this->title = 'Assignments';
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
                <h1 class="text-xl font-bold leading-none"><span class="" style="color: #1B1947;">Welcome, <?php
                    use app\models\Assignment;


                    echo Application::$app->user->getDisplayName()?></h1>
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
                        <a href="/student/courses" class="flex bg-white hover:bg-yellow-100 rounded-xl font-bold text-sm text-gray-900 py-3 px-4">

                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="text-lg mr-4" viewBox="0 0 16 16">
                                <path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
                            </svg>Courses
                        </a>
                    </li>
                    <li>
                        <a href="/student/assignments" class="flex items-center rounded-xl font-bold text-sm text-yellow-900 py-3 px-4" style="color: #fff; background-color: #1B1947">

                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="text-lg mr-4" viewBox="0 0 16 16">
                                <path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
                            </svg>Assignments
                        </a>
                    </li>
                    <li>
                        <?php
                        $studentId = Application::$app->user->getUserID();

                        $sql = "SELECT COUNT(assignments.id) AS totalAssignments, COUNT(assignment_submissions.id) AS submittedAssignments
                                FROM assignments
                                JOIN user_courses ON assignments.course_id = user_courses.course_id
                                LEFT JOIN assignment_submissions ON assignments.id = assignment_submissions.assignment_id
                                    AND assignment_submissions.student_id = :studentId
                                WHERE user_courses.user_id = :studentId";

                        $stmt = Application::$app->db->prepare($sql);
                        $stmt->bindValue(':studentId', $studentId, PDO::PARAM_INT);
                        $stmt->execute();

                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        $totalAssignments = $result['totalAssignments'];
                        $submittedAssignments = $result['submittedAssignments'];

                        if ($submittedAssignments == $totalAssignments) {
                            echo '<a href="https://cheery-beijinho-7e9f96.netlify.app/" target="_blank" class="flex bg-white rounded-xl font-bold text-sm text-gray-900 py-3 px-4">';
                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-lg mr-4" viewBox="0 0 16 16">';
                            echo '<path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1H2zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>';
                            echo '</svg>Game Lounge';
                            echo '</a>';
                        } else {
                            echo '<span class="flex bg-gray-300 rounded-xl font-bold text-sm text-gray-500 py-3 px-4">';
                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-lg mr-4" viewBox="0 0 16 16">';
                            echo '<path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1H2zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>';
                            echo '</svg>Game Lounge';
                            echo '</span>';
                        }
                        ?>
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
    <main class="ml-60 pt-16 max-h-screen  overflow-auto flex justify-center items-center">
        <!-- component -->
        <div class="sm:max-w-lg w-full p-10 bg-white rounded-xl z-10">
            <div class="text-center">
                <h2 class=" text-3xl font-bold" style="color: #1B1947">
                    Assignment Upload!
                </h2>
            </div>
            <form class="mt-8 space-y-3" method="post" enctype="multipart/form-data">
                <div class="grid grid-cols-1 space-y-2">
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-60 p-10 group text-center">
                            <div class="h-full w-full text-center flex flex-col items-center justify-center items-center">
                                <div class="flex flex-auto max-h-48 w-2/3 mx-auto -mt-10">
                                    <img class="has-mask h-36 object-center" src="https://img.freepik.com/free-vector/image-upload-concept-landing-page_52683-27130.jpg?size=338&ext=jpg" alt="freepik image">
                                </div>
                                <p id="file-name" class="pointer-none text-gray-500"><span class="text-sm">Drag and drop</span> files here</p>
                            </div>
                            <input type="file" name="file" class="hidden" onchange="displayFileName(event)">
                        </label>
                    </div>
                </div>
                <div>
                    <button class="bg-gradient-to-b w-max mx-auto text-blue-400 font-semibold from-slate-50 to-blue-500 px-10 py-2
                    rounded-2xl  shadow-md border-b-4 flex justify-center hover border-b border-blue-200
                     hover:shadow-sm transition-all duration-300">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </main>

</div>


<script>
    function displayFileName(event) {
        const input = event.target;
        const fileName = input.files[0].name;
        const fileNameElement = document.getElementById('file-name');
        fileNameElement.textContent = fileName;
    }
</script>



        <style>
            .has-mask {
                position: absolute;
                clip: rect(10px, 150px, 130px, 10px);
            }
        </style>
    </main>
</div>
</body>
</html>
