<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleWare(new AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response): array|bool|string
    {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());



            if ($loginForm->validate() && $loginForm->login()  ) {

                $user = User::findOne(['username' => $loginForm->username]);

                if ($user->type === 'Teacher') {
                    $response->redirect('/teacher/dashboard');
                    exit;
                    //return $this->render('teacher_dashboard');
                } elseif ($user->type === 'Student') {
                    $response->redirect('/student/dashboard');
                    exit;

                }elseif ($user->type === 'Admin') {
                    $response->redirect('/admin/dashboard');
                    exit;
                }
            }
        }
        $this->setLayout('auth');
        return $this->render('/login', [
            'model' => $loginForm
        ]);
    }
    public function register(Request $request)
    {
        $user = new User();
        if ($request->isPost()) {
           $user->loadData($request->getBody());

           if ($user->validate() && $user->save()) {
              // Application::$app->session->setFlash('success', 'Thanks for registering');
               Application::$app->response->redirect('/admin/dashboard');
               exit;
           }
        }
        $this->setLayout('auth');

        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function logout(Request $request, Response $response): void
    {
        Application::$app->logout();
        $response->redirect('/login');
    }

    public function profile(): array|bool|string
    {
        //Application::$app->
        return $this->render('profile');
    }

    public function viewUsers(): array|bool|string
    {
        return $this->render('view_users');
    }


}