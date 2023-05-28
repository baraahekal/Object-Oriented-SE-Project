<?php

namespace app\models;

use app\core\ModuleModel;


class AssignmentSubmission extends ModuleModel
{
    public int $id;
    public int $assignment_id;
    public int $student_id;
    public string $file_path;
    public string $submitted_at;

    public static function tableName(): string
    {
        return 'assignment_submissions';
    }
    public static function primaryKey(): string
    {
        return 'id';
    }

    public function attributes(): array
    {
        return ['assignment_id', 'student_id', 'file_path', 'submitted_at'];
    }

    public function rules(): array
    {
        return [
            'assignment_id' => [self::RULE_REQUIRED],
            'student_id' => [self::RULE_REQUIRED],
            'file_path' => [self::RULE_REQUIRED],
            'submitted_at' => [self::RULE_REQUIRED],
        ];
    }
    public function isSubmitted()
    {
        // Add your logic to determine if the assignment is submitted
        // For example, you can check if the submission date is not null
        return $this->submitted_at !== null;
    }
    public function getCourseName(): string
    {
        return '';
    }
    public function getCourseInstructor(): string
    {
        return '';
    }

    public function getCoursesNumber(): string
    {
        return '';
    }

    public function getTeacherCourses($teacher): array
    {
        return [];
    }

    public function getAllCoursesNames(): array
    {
        return [];
    }

    public function getAllCoursesCodes(): array
    {
        return [];
    }

    public function getAllCourses(): array
    {
        return [];
    }
}
