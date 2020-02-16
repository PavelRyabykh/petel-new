<?php


namespace app\controllers\admin;


use app\controllers\AppController;
use app\models\User;
use vendor\core\Auth;

class AdminController extends MainAdminController
{
    public function indexAction()
    {
        Auth::faceControlForAdmin();
        $user = new User();
        $users = $user->findAll();
        unset($users[(count($users) - 1)]);
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
        $this->set(compact('users'));
    }
}