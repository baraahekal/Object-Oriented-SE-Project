<?php

namespace app\models;

use SplObserver;
use SplSubject;

class Admin extends User implements SplObserver
{
    // Admin-specific properties and methods

    public static function tableName(): string
    {
        return 'admins';
    }



    // Additional methods specific to Admin model
    public function update(SplSubject $subject): void
    {
        // TODO: Implement update() method.
    }
}
