<?php

namespace app\models;
use SplObserver;
use SplSubject;

class Quiz extends Task implements SplObserver
{
    public function gradeSubmission($submissionId, $grade)
    {
        // Logic to grade a student's assignment submission
    }
    public static function tableName(): string
    {
        return 'quizzes';
    }
    public function update(SplSubject $subject): void
    {
        // Handle the update logic here
        echo "Quiz observer received an update from the subject.<br>";
        // This method will be called when the subject updates
    }
}
