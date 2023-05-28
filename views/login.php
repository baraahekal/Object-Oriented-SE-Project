<?php
/** @var $model \app\models\User */




use app\core\Application;
use app\core\View;
/** @var $this View */

$this->title = 'login';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            background-color: #1B1947;
            color: #1B1947;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        @keyframes slideUp {
            0% {
                bottom: -300px;
                opacity: 1;
            }
            100% {
                bottom: -15px;
                opacity: 1;
            }
        }

        .form-container {
            position: fixed;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #fff;
            padding: 70px; /* Increase the padding value */
            border-radius: 20px;
            align-items: flex-end;
            /*text-align: center;*/
            width: 34%; /* Adjust the maximum width as needed */
            padding-top: 80px;
            box-shadow: 7px -2px 0px 5px #B99F69;
            animation: slideUp 1.6s ease-in-out;
        }

        .btn-primary {
            background-color: #1B1947;
            color: #fff;
            border: none;
            width: 100%;
            border-radius: 5px;
            padding: 10px 20px;
            margin-top: 10px;
            cursor: pointer;
            align-items: center;
            margin-bottom: 30px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .welcome-heading {
            text-align: center;
            color: #fff;
            font-size: 24px;
        }

        .subheading {
            text-align: center;
            color: #ccc;
            font-size: 16px;
        }

        .welcoming {
            margin-bottom: 100px;
            font-size: 100px;
        }
    </style>
</head>
<body>

<div class="welcoming">
    <h1 class="welcome-heading" style="font-size: 40px">Hi, Welcome Back!</h1>
    <p class="subheading">Sign in to access your account and the whole features.</p>
</div>

<div class="form-container">
    <?php $form = \app\core\form\Form::begin('', "post") ?>
    <?php echo $form->field($model, 'username') ?>
    <?php echo $form->field($model, 'password')->passwordField() ?>
    <div style="display: flex; justify-content: center; align-items: center;">
        <button type="submit" class="btn btn-primary">Login</button>
    </div>
    <?php \app\core\form\Form::end() ?>
</div>
</body>
</html>
