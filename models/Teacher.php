<?php

namespace app\models;

use app\core\Observer;
use SplSubject;

class Teacher extends User implements \SplObserver
{
    public function update(SplSubject $subject): void
    {
        echo "Teacher observer received an update from the subject.<br>";
    }
    public function createModule($moduleData)
    {
        // Logic to create a new module
    }

    public function gradeTask($taskId, $grade)
    {
        // Logic to grade a task submitted by a student
    }

    public static function tableName(): string
    {
        return 'teachers';
    }


}
