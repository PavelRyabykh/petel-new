<?php


namespace app\controllers\admin;

use app\models\Filter;
use app\models\Url;
use app\models\User;
use vendor\core\Auth;
use vendor\core\Validator;

class SignupController extends MainAdminController
{
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
            header('Location: /admin');
            exit();
        }

        if ($user->add()) {
            $url = new Url();
            $filter = new Filter();
            $url->table = $user->login;
            $filter->table = $user->login . '_filters';
            $url->createTable();
            $filter->createTable();
            $_SESSION['status'] = true;
            header('Location: /admin');
            exit();
        } else {
            $_SESSION['status'] = false;
            $_SESSION['errors'] = $user->errors;
            header('Location: /admin');
            exit();
        }
    }
}