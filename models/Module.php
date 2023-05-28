<?php

namespace app\models;

use app\core\Application;
use app\core\Model;
use app\core\ModuleModel;
use app\core\UserModel;
use PDO;
use SplObjectStorage;
use SplObserver;
use SplSubject;

class Module extends ModuleModel implements SplSubject
{
    public string $course_code = '';
    public string $instructor = '';
    public string $description = '';
    public int $id;
    public ?string $course_name = null;
    public ?int $level_id = null;


    private SplObjectStorage $observers;

    public static function findByAttributes(array $attributes)
    {
        $tableName = self::tableName();
        $columns = implode(',', array_keys($attributes));
        $params = [];

        $whereConditions = [];
        foreach ($attributes as $column => $value) {
            $whereConditions[] = "$column = :$column";
            $params[":$column"] = $value;
        }

        $sql = "SELECT * FROM $tableName WHERE " . implode(' AND ', $whereConditions);
        $result = Application::$app->db->prepare($sql);
        $result->execute($params);

        // Retrieve the module record
        $moduleData = $result->fetch();

        if (!$moduleData) {
            return null;
        }

        $module = new Module();
        $module->loadData($moduleData);

        return $module;
    }



    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function notify(): void
    {
        /* @var SplObserver $observer */
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }


    public function getTasks()
    {
        // Logic to retrieve all tasks associated with the module
    }

    public function getAssignments()
    {
        // Logic to retrieve all assignments associated with the module
    }

    public function rules(): array
    {
        return [
            'course_code' => [self::RULE_REQUIRED],
            'course_name' => [self::RULE_REQUIRED],
            'instructor' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED],
            'level_id' => [self::RULE_REQUIRED],
        ];
    }
    public function labels(): array
    {
        return [
            'course_code' => 'Course Code',
            'course_name' => 'Course Name',
            'instructor' => 'Course Instructor',
            'description' => 'Course Description',
            'level_id' => 'Level',
        ];
    }
    public function attributes(): array
    {
        return ['course_code', 'course_name', 'instructor','description', 'level_id'];
    }
    public static function tableName(): string
    {
        return 'courses';
    }
    public function createTask($taskData)
    {
        // Existing logic to create a task

        // Notify observers about the new task
        $this->notify($taskData);
    }
    public function update()
    {
        $tableName = static::tableName();

        $attributes = $this->attributes();

        $params = [];
        $setValues = [];
        foreach ($attributes as $attribute) {
            $params[":{$attribute}"] = $this->{$attribute};
            $setValues[] = "{$attribute} = :{$attribute}";
        }

        $query = "UPDATE {$tableName} SET " . implode(", ", $setValues) . " WHERE course_code = :course_code";
        $params[':course_code'] = $this->course_code;

        $statement = self::prepare($query);
        return $statement->execute($params);
    }





    public function getCourseName(): string
    {
        return $this->course_name;
    }

    public function getCourseInstructor(): string
    {
        return $this->instructor;
    }

    public static function primaryKey(): string
    {
        return 'id';
    }



    public function getCoursesNumber(): string
    {
        $db = Application::$app->db;
        $tableName = static::tableName();

        $query = "SELECT COUNT(*) as count FROM $tableName";
        $result = $db->pdo->query($query);

        if ($result === false) {
            return 0;
        }

        $row = $result->fetch(PDO::FETCH_ASSOC);
        $count = isset($row['count']) ? (int)$row['count'] : 0;

        return $count;
    }


    public function delete(): bool
    {
        $primaryKey = self::primaryKey();
        $tableName = self::tableName();

        $db = Application::$app->db;
        $db->pdo->beginTransaction();

        try {
            // Check if the table has a foreign key constraint
            $hasForeignKey = $this->hasForeignKeyConstraint('user_courses');

            if ($hasForeignKey) {
                // Get the course ID before deletion
                $courseId = $this->{$primaryKey};

                // Delete the corresponding entries from the "user_courses" table
                $userCoursesTableName = 'user_courses'; // Replace with the actual table name for user_courses
                $sql = "DELETE FROM $userCoursesTableName WHERE course_id = :course_id";
                $statement = $db->pdo->prepare($sql);
                $statement->bindValue(':course_id', $courseId);
                $statement->execute();
            }

            // Delete the course from the "courses" table
            $sql = "DELETE FROM $tableName WHERE $primaryKey = :id";
            $statement = $db->pdo->prepare($sql);
            $statement->bindValue(':id', $this->{$primaryKey});
            $statement->execute();

            $db->pdo->commit();
            return true;
        } catch (\Exception $e) {
            $db->pdo->rollBack();
            return false;
        }
    }

    private function hasForeignKeyConstraint(string $tableName): bool
    {
        $db = Application::$app->db;
        $query = "SELECT COUNT(*) 
              FROM information_schema.TABLE_CONSTRAINTS 
              WHERE CONSTRAINT_TYPE = 'FOREIGN KEY' 
              AND TABLE_SCHEMA = DATABASE() 
              AND TABLE_NAME = :table_name";

        $statement = $db->pdo->prepare($query);
        $statement->bindValue(':table_name', $tableName);
        $statement->execute();

        $count = $statement->fetchColumn();
        return $count > 0;
    }

    public function getTeacherCourses($teacher): array
    {
        $db = Application::$app->db;
        $tableName = static::tableName();
        $teacherCourses = [];

        $query = "SELECT * FROM $tableName WHERE instructor = :teacher";
        $statement = $db->pdo->prepare($query);
        $statement->bindValue(':teacher', $teacher);
        $statement->execute();

        $teacherCourses = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $teacherCourses;
    }

    public function getAllCoursesNames(): array
    {

        $tableName = static::tableName();

        $query = "SELECT course_name FROM $tableName";
        $statement = self::prepare($query);
        $statement->execute();

        $courseCodes = $statement->fetchAll(PDO::FETCH_COLUMN);

        return $courseCodes;
    }

    public function getAllCourses(): array
    {
        $db = Application::$app->db;
        $tableName = static::tableName();

        $query = "SELECT * FROM $tableName";
        $statement = $db->pdo->prepare($query);
        $statement->execute();

        $courses = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $courses;
    }

    public function getAllCoursesCodes(): array
    {
        $tableName = static::tableName();

        $query = "SELECT course_code FROM $tableName";
        $statement = self::prepare($query);
        $statement->execute();

        $courseCodes = $statement->fetchAll(PDO::FETCH_COLUMN);

        return $courseCodes;
    }
    public function getLevelCourses($id): array
    {
        $db = Application::$app->db;
        $coursesTable = 'courses'; // Replace with the actual table name for courses

        $query = "SELECT * FROM $coursesTable WHERE level_id = :id";
        $statement = $db->pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $courses = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $courses;
    }

}