<?php
namespace app\models;
use app\core\Application;
use app\core\UserModel;
use app\core\DbModel;
use PDO;

class User extends UserModel
{


    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $type = '';

    public string $username = '';

    public string $password = '';
    public ?int $level_id = null;
    public string $confirmPassword = '';
    public mixed $name;
    const RULE_EMAIL = 'email';
    public static function tableName(): string
    {
        return 'users';
    }

    public static function findByType(string $type)
    {
        $tableName = self::tableName();
        // Assuming you have a database connection established
        $stmt = self::prepare("SELECT * FROM $tableName WHERE type = :type");
        $stmt->bindValue(':type', $type);
        $stmt->execute();

        // Fetch all the rows as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function primaryKey(): string
    {
        return 'id';
    }

    public function save()
    {
        if ($this->type === 'Teacher' || $this->type === 'Admin') {
            $this->level_id = null;
        }
        if ($this->username === 'root') {
            $this->type = 'Admin';
        }
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }
    public function update(): bool
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::update();
    }


    public function rules() : array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],

            'type' => [self::RULE_REQUIRED],
            'level_id' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE, 'class' => self::class
            ]],
            'username' => [self::RULE_REQUIRED, [
                self::RULE_UNIQUE, 'class' => self::class
            ]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4], [self::RULE_MAX, 'max' => 24]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function attributes(): array
    {
        return ['firstname', 'lastname', 'username','email', 'type', 'password', 'confirmPassword', 'level_id'];
    }
    public function labels(): array
    {
        return [
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'username' => 'Username',
            'email' => 'Email',
            'type' => 'Role',
            'password' => 'Password',
            'confirmPassword' => 'Confirm Password',
            'level_id' => 'Level',
        ];
    }
    public function getDisplayName(): string
    {
        return $this->firstname;
    }
    public function getType(): string
    {
        return $this->type;
    }
    public static function findAll(): bool|array
    {
        $tableName = self::tableName();

        $sql = "SELECT * FROM $tableName";
        $statement = self::prepare($sql);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function delete(): bool
    {
        $primaryKey = self::primaryKey();
        $tableName = self::tableName();

        $sql = "DELETE FROM $tableName WHERE $primaryKey = :id";
        $statement = self::prepare($sql);
        $statement->bindValue(':id', $this->{$primaryKey});

        return $statement->execute();
    }

    public function getStudentsNumber(): string
    {
        $tableName = self::tableName();
        $type = 'Student';

        $sql = "SELECT COUNT(*) FROM $tableName WHERE type = :type";
        $statement = self::prepare($sql);
        $statement->bindValue(':type', $type);
        $statement->execute();

        return $statement->fetchColumn();
    }

    public function getTeachersNumber(): string
    {
        $tableName = self::tableName();
        $type = 'Teacher';

        $sql = "SELECT COUNT(*) FROM $tableName WHERE type = :type";
        $statement = self::prepare($sql);
        $statement->bindValue(':type', $type);
        $statement->execute();

        return $statement->fetchColumn();
    }

    public function getUserCoursesNumber(int $userId): int
    {
        $db = Application::$app->db;
        $tableName = 'user_courses'; // Replace with the actual table name for user_course

        $query = "SELECT COUNT(*) as count FROM $tableName WHERE user_id = :user_id";
        $statement = $db->pdo->prepare($query);
        $statement->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $count = isset($row['count']) ? (int)$row['count'] : 0;

        return $count;
    }
    public function getUserID(): ?int
    {
        return $this->id ?? null;
    }
    public function getUserEnrolledCourses()
    {
        $userId = Application::$app->user->id; // Assuming you have a user ID available

        $db = Application::$app->db;
        $coursesTable = 'courses'; // Replace with the actual table name for courses
        $userCoursesTable = 'user_courses'; // Replace with the actual table name for user_course

        $query = "SELECT c.* FROM $coursesTable c
              INNER JOIN $userCoursesTable uc ON uc.course_id = c.id
              WHERE uc.user_id = :user_id";
        $statement = $db->pdo->prepare($query);
        $statement->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();

        $enrolledCourses = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $enrolledCourses;
    }

    public function getTeachersList()
    {
        $db = Application::$app->db;
        $usersTable = 'users'; // Replace with the actual table name for users

        $query = "
        SELECT *
        FROM $usersTable
        WHERE type = 'Teacher'
    ";

        $statement = $db->pdo->prepare($query);
        $statement->execute();

        $teachers = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $teachers;
    }
    public function getFullName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

}