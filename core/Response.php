<?php

namespace app\core;

class Response
{


    public function redirect(string $url)
    {
        header('Location: '.$url);
    }



}