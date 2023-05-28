<?php

namespace app\controllers;

use app\core\Application;
use app\core\ModelFactory;
use PDO;

class UserController extends Controller
{
    public function createAction()
    {
        $userModel = ModelFactory::createModel('user');


        return $this->render('create', [
            'model' => $userModel,
        ]);
    }




}
