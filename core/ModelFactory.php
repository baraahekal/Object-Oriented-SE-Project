<?php

namespace app\core;

use app\models\User;
use app\models\Admin;
use app\models\Student;
use app\models\Teacher;

class ModelFactory
{
    public static function createModel($modelType)
    {
        return match ($modelType) {
            'user' => new User(),
            'admin' => new Admin(),
            'student' => new Student(),
            'teacher' => new Teacher(),
            default => throw new \InvalidArgumentException("Invalid model type: $modelType"),
        };
    }
}




