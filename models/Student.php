<?php

namespace app\models;

use app\core\Observer;
use SplObserver;
use SplSubject;

class Student extends User implements SplObserver
{
    public function update(SplSubject $subject)
    {
        echo "Student observer received an update from the subject.<br>";
    }
    public function enrollInModule($moduleId)
    {
        // Logic to enroll the student in a module
    }

    public function submitTask($taskId, $submission)
    {
        // Logic to submit a task by the student
    }

    public static function tableName(): string
    {
        return 'students';
    }

}