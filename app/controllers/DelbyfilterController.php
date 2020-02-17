<?php


namespace app\controllers;


use app\models\Url;
use vendor\core\Auth;
use vendor\core\Validator;

class DelbyfilterController extends AppController
{
    public function indexAction()
    {
        Auth::faceControl();
        $this->layout = false;
        $url = new Url();
        $url->deleteByFilter($this->post->filter);
    }
}