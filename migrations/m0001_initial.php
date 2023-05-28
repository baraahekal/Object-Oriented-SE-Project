<?php

use app\core\Application;

class m0001_initial {
    public function up(): void
    {
        $db = Application::$app->db;
        $SQL = "CREATE TABLE levels (
    id INT PRIMARY KEY AUTO_INCREMENT,
    level_name VARCHAR(255) NOT NULL
) ENGINE=INNODB;";
        $db->pdo->exec($SQL);


        $SQL = "CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            username VARCHAR(255) NOT NULL UNIQUE,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            type VARCHAR(255) NOT NULL,
            level_id INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (level_id) REFERENCES levels(id) ON DELETE SET NULL
        ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);

        $SQL = "CREATE TABLE courses (
            id INT PRIMARY KEY AUTO_INCREMENT,
            course_code VARCHAR(255) NOT NULL,
            course_name VARCHAR(255) NOT NULL,
            instructor VARCHAR(255) NOT NULL,
            description VARCHAR(255),
            level_id INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (level_id) REFERENCES levels(id) ON DELETE SET NULL
        ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);

        $SQL = "CREATE TABLE user_courses (
            user_id INT,
            course_id INT,
            PRIMARY KEY (user_id, course_id),
            FOREIGN KEY (user_id) REFERENCES users(id),
            FOREIGN KEY (course_id) REFERENCES courses(id)
        ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);

        $SQL = "CREATE TABLE assignments (
            id INT PRIMARY KEY AUTO_INCREMENT,
            course_id INT NOT NULL,
            title VARCHAR(255) NOT NULL,
            description VARCHAR(255),
            file_path LONGBLOB,
            due_date TIMESTAMP,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (course_id) REFERENCES courses (id) ON DELETE CASCADE
        ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);

        $SQL = "CREATE TABLE assignment_submissions (
            id INT PRIMARY KEY AUTO_INCREMENT,
            assignment_id INT NOT NULL,
            student_id INT NOT NULL,
            file_path LONGBLOB,
            submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (assignment_id) REFERENCES assignments (id) ON DELETE CASCADE,
            FOREIGN KEY (student_id) REFERENCES users (id) ON DELETE CASCADE
        ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);


    }

    public function down(): void
    {
        $db = Application::$app->db;
        $SQL = "DROP TABLE users;";
        $db->pdo->exec($SQL);
        }
}