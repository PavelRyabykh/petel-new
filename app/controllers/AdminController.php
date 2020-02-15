<?php


namespace app\controllers;


use vendor\core\Auth;

class AdminController extends AppController
{
    public function indexAction()
    {
        Auth::faceControlForAdmin();
    }
}