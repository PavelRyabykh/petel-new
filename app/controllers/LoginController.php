<?php


namespace app\controllers;



use app\models\User;
use vendor\core\Auth;
use vendor\core\Validator;

class LoginController extends AppController
{

    public function indexAction()
    {
        if (Auth::faceControl('login')) {
            header('Location: /');
            exit();
        }

        if (isset($_SESSION['status'])) {
            if ($_SESSION['status'] === false) {
                $errorMessages = $_SESSION['errors'];
                unset($_SESSION['status']);
                unset($_SESSION['errors']);
                $this->set(compact('errorMessages'));
            }

        }
    }

    public function checkAction()
    {
        if (Auth::faceControl('login')) {
            header('Location: /');
            exit();
        }

        $user = new User();
        $this->layout = false;
        if (! ($errors = Validator::login($this->post->login, $this->post->password))) {
            $user->login = trim(strtolower(htmlspecialchars($this->post->login)));
            $user->password = $this->post->password;
        } else {
            $_SESSION['status'] = false;
            $_SESSION['errors'] = $errors;
            header('Location: /login');
            exit();
        }
        if ($user->checkAuth() === -1) {
            Auth::setUser($user->properties['login']);
            Auth::setStatus(0);
            header('Location: /');
            exit();
        } elseif ($user->checkAuth() === 1) {
            Auth::setUser($user->properties['login']);
            Auth::setStatus(1);
            header('Location: /admin');
            exit();
        } else {
            $_SESSION['status'] = false;
            $_SESSION['errors'] = $user->errors;
            header('Location: /login');
            exit();
        }
    }
}