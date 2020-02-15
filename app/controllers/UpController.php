<?php


namespace app\controllers;


use app\models\Url;
use vendor\core\Auth;

class UpController extends AppController
{
    public function indexAction()
    {
        Auth::faceControl();
        $this->layout = false;
        $url = new Url();
        $data = $url->findOne($this->post->up);
        if ($data) {
            $url->delete($this->post->up);
            $url->url = $data['url'];
            $url->color = $data['color'];
            $url->add();
            header('Location: /');
        }
    }
}