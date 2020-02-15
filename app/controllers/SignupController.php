<?php


namespace app\controllers;


use app\models\Url;
use app\models\User;
use vendor\core\Auth;
use vendor\core\Validator;

class SignupController extends AppController
{
    public function indexAction()
    {
        Auth::faceControlForAdmin();

        if (isset($_SESSION['status'])) {

            if ($_SESSION['status'] === true) {
                $successMessage = 'Пользователь успешно добавлен!';
                unset($_SESSION['status']);
                $this->set(compact('successMessage'));
            } else {
                $errorMessages = $_SESSION['errors'];
                unset($_SESSION['status']);
                unset($_SESSION['errors']);
                $this->set(compact('errorMessages'));
            }

        }
    }

    public function addUserAction()
    {
        Auth::faceControlForAdmin();

        $user = new User();
        //Добавляю нового пользователя в базу данных::POST
        $this->layout = false;
        //Провожу валидацию данных
        //Если все ок, добавляю данные в модель и создаю отдельную таблицу урлов для этого пользователя, которая будет соответствовать его UserName
        if (! ($errors = Validator::signup($this->post->login, $this->post->password))) {
            $user->login = htmlspecialchars($this->post->login);
            $user->password = password_hash($this->post->password, PASSWORD_DEFAULT);
        } else {
            $_SESSION['status'] = false;
            $_SESSION['errors'] = $errors;
            header('Location: /signup');
            exit();
        }

        if ($user->add()) {
            $url = new Url();
            $url->table = $user->login;
            $url->createTable();
            $_SESSION['status'] = true;
            header('Location: /signup');
            exit();
        } else {
            $_SESSION['status'] = false;
            $_SESSION['errors'] = $user->errors;
            header('Location: /signup');
            exit();
        }
    }
}