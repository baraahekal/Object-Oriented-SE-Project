<?php

namespace app\models;

use app\core\Observer;
use SplSubject;

class Task extends Module implements \SplObserver
{
    public function markAsCompleted($taskId)
    {
        // Logic to mark a task as completed
    }
    public static function tableName(): string
    {
        return 'tasks';
    }
    public function update(SplSubject $subject): void
    {
        // Handle the update logic here
        echo "Task observer received an update from the subject.<br>";
        // This method will be called when the subject updates
    }
}
