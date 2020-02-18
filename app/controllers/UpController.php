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
        if ($url->findOne($this->post->up)) {
            $data = $url->findOne($this->post->up);
        } elseif ($url->findOne($this->post->up, 'old_id')) {
            $data = $url->findOne($this->post->up, 'old_id');
        }
            $url->url = $data['url'];
            $url->filter = $data['filter'];
            $url->old_id = $data['id'];
            $url->add();
    }
}