<?php

namespace app\models;

use app\core\Application;
use app\core\Model;
use app\core\ModuleModel;
use app\core\UserModel;
use PDO;

class Assignment extends ModuleModel
{
    public ?int $course_id = null;
    public string $title;
    public string $description;
    public string $file_path;
    public string $due_date;

    public function gradeSubmission($submissionId, $grade)
    {
        // Logic to grade a student's assignment submission
    }
    public static function tableName(): string
    {
        return 'assignments';
    }
    public static function countAssignments($studentId)
    {
        $db = Application::$app->db;
        $tableName = static::tableName();

        // Count total assignments
        $totalSQL = "SELECT COUNT(*) FROM $tableName";
        $totalStatement = $db->pdo->prepare($totalSQL);
        $totalStatement->execute();
        $totalAssignments = $totalStatement->fetchColumn();

        // Count submitted assignments by the student
        $submittedSQL = "SELECT COUNT(*) FROM $tableName AS a
                     INNER JOIN assignment_submissions AS s ON a.id = s.assignment_id
                     WHERE s.student_id = :studentId";
        $submittedStatement = $db->pdo->prepare($submittedSQL);
        $submittedStatement->bindValue(':studentId', $studentId, PDO::PARAM_INT);
        $submittedStatement->execute();
        $submittedAssignments = $submittedStatement->fetchColumn();

        return [
            'totalAssignments' => $totalAssignments,
            'submittedAssignments' => $submittedAssignments
        ];
    }

    public static function findAllByStudentId($studentId)
    {
        $db = Application::$app->db;
        $tableName = static::tableName();


        $SQL = "SELECT * FROM $tableName WHERE student_id = :studentId";
        $statement = $db->pdo->prepare($SQL);
        var_dump($statement);
        exit;
        $statement->bindValue(':studentId', $studentId, PDO::PARAM_INT);
        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Create an array of AssignmentSubmission objects
        $submissions = [];
        foreach ($results as $result) {
            $submission = new AssignmentSubmission();
            $submission->loadData($result);
            $submissions[] = $submission;
        }

        return $submissions;
    }


    public static function findAll($condition = [])
    {
        // Build the SQL query
        $sql = "SELECT * FROM assignments";
        $params = [];

        // Check if any condition is specified
        if (!empty($condition)) {
            $where = [];
            foreach ($condition as $key => $value) {
                $where[] = "$key = :$key";
                $params[":$key"] = $value;
            }
            $sql .= " WHERE " . implode(' AND ', $where);
        }

        // Execute the query
        $stmt = Application::$app->db->prepare($sql);
        $stmt->execute($params);

        // Fetch all the rows and return as an array of Assignment objects
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $assignments = [];
        foreach ($rows as $row) {
            $assignment = new Assignment();
            $assignment->loadData($row);
            $assignments[] = $assignment;
        }

        return $assignments;
    }



    public function attributes(): array
    {
        return ['course_id', 'title', 'description', 'file_path', 'due_date'];
    }


    public static function primaryKey(): string
    {
        return '';
    }

    public function rules(): array
    {
        return [];

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
