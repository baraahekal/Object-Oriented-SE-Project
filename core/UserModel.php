<?php

namespace app\core;

use app\core\db\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
    abstract public function delete(): bool;
    abstract public function update(): bool;
    abstract public function getType(): string;
    abstract public function getStudentsNumber(): string;

    abstract public function getTeachersNumber(): string;
    abstract public function getUserCoursesNumber(int $userId): int;
    abstract public function getUserID(): ?int;
    abstract public function getUserEnrolledCourses();


}