<?php


namespace app\controllers;


use vendor\core\Auth;

class LogoutController extends AppController
{
    public function indexAction()
    {
        $this->layout = false;
        Auth::unsetUser();
        header('Location: /login');
    }
}