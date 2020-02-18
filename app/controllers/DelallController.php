<?php


namespace app\controllers;


use app\models\Url;
use vendor\core\Auth;

class DelallController extends AppController
{
    public function indexAction()
    {
        Auth::faceControl();
        $url = new Url();
        $this->layout = false;
        $url->deleteAll();
    }
}