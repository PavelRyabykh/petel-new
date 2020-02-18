<?php


namespace app\controllers;


use app\models\Url;
use vendor\core\Auth;
use vendor\core\Validator;

class DelurlController extends AppController
{
    public function indexAction()
    {
        Auth::faceControl();
        $url = new Url();
        $this->layout = false;
        if (Validator::integer($this->post->id)) {
            $url->delete($this->post->id);
        }
    }
}