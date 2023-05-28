<?php

namespace app\core;

abstract class ModuleModel extends DbModel
{
    abstract public function getCourseName(): string;
    abstract public function getCourseInstructor(): string;
    abstract public function getCoursesNumber(): string;
    abstract public function getTeacherCourses($teacher): array;
    abstract public function getAllCoursesNames(): array;
    abstract public function getAllCoursesCodes(): array;
    abstract public function getAllCourses(): array;


}