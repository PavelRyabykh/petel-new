<?php

namespace app\controllers;


use app\models\Filter;
use app\models\Url;
use vendor\core\Auth;
use vendor\core\Validator;

class MainController extends AppController
{

    public function indexAction()
    {
        Auth::faceControl();
        $url = new Url();
        $filter = new Filter();

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
        $filters = $filter->findAll();
        $colors = [];
        foreach ($filters as $filter) {
            $colors[$filter['filter']] = $filter['color'];
        }
        $this->set(compact('data', 'filters', 'colors'));
    }

    public function AddUrlAction()
    {
        Auth::faceControl();
        $url = new Url();
        $this->layout = false;

        if (!($errors = Validator::url($this->post->url)) && $this->post->filter !== null) {
            if ($this->post->notformat === 'on') {
                $url->url = htmlspecialchars($this->post->url);
            } else {
                $url->url = ahrefer(htmlspecialchars($this->post->url));
            }
            $url->filter = $this->post->filter;
        } else {
            $_SESSION['status'] = false;
            $_SESSION['errors'] = $url->errors;
            header('Location: /#' . $this->post->filter);
            exit();
        }

        if ($url->add()) {
            $_SESSION['status'] = true;
            header('Location: /#' . $this->post->filter);
            exit();
        } else {
            $_SESSION['status'] = false;
            $_SESSION['errors'] = $url->errors;
            header('Location: /#' . $this->post->filter);
            exit();
        }

    }
}