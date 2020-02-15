<?php


namespace app\controllers;


use app\models\Url;
use vendor\core\Auth;
use vendor\core\Validator;

class DelbycolorController extends AppController
{
    public function indexAction()
    {
        Auth::faceControl();
        $this->layout = false;
        $url = new Url();
        if (Validator::color($this->post->color, $this->legacyColors)) {
            $url->deleteByColor($this->post->color);
        } else {
            throw new \Exception("Попытка передать нелегальные данные цвета при удалении группы урлов по цвету");
        }


    }
}