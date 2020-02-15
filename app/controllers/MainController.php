<?php

namespace app\controllers;


use app\models\Url;
use vendor\core\Auth;
use vendor\core\Validator;

class MainController extends AppController
{

    public function indexAction()
    {
        Auth::faceControl();
        $url = new Url();

        if (isset($_SESSION['status'])) {

            if ($_SESSION['status'] === true) {
                $successMessage = 'URL успешно добавлен!';
                unset($_SESSION['status']);
                $this->set(compact('successMessage'));
            } else {
                $errorMessages = $_SESSION['errors'];
                unset($_SESSION['status']);
                unset($_SESSION['errors']);
                $this->set(compact('errorMessages'));
            }

        }

        $data = $url->findAll();
        $legacyColors = $this->legacyColors;
        $this->set(compact('data', 'legacyColors'));
    }

    public function AddUrlAction()
    {
        Auth::faceControl();
        $url = new Url();
        $this->layout = false;

        if (! ($errors = Validator::url($this->post->url)) && Validator::color($this->post->color, $this->legacyColors)) {
            if($this->post->notformat === 'on') {
                $url->url = htmlspecialchars($this->post->url);
            } else {
                $url->url = ahrefer(htmlspecialchars($this->post->url));
            }
            $url->color = $this->post->color ?? 'blue';
        } else {
            $_SESSION['status'] = false;
            $_SESSION['errors'] = $url->errors;
            header('Location: /');
            exit();
        }

        if ($url->add()) {
            $_SESSION['status'] = true;
            header('Location: /');
            exit();
        } else {
            $_SESSION['status'] = false;
            $_SESSION['errors'] = $url->errors;
            header('Location: /');
            exit();
        }
        
    }
}