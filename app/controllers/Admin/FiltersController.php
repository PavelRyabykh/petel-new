<?php


namespace app\controllers\Admin;


use app\controllers\AppController;
use app\models\Filter;
use vendor\core\Auth;

class FiltersController extends MainAdminController
{
    public function indexAction()
    {
        Auth::faceControlForAdmin();
        $filter = new Filter();
        $user = $this->route['user'];
        $filter->table = $user . '_filters';

        if (isset($_SESSION['status'])) {

            if ($_SESSION['status'] === true) {
                $successMessage = 'Фильтр успешно добавлен!';
                unset($_SESSION['status']);
                $this->set(compact('successMessage'));
            } else {
                $errorMessages = $_SESSION['errors'];
                unset($_SESSION['status']);
                unset($_SESSION['errors']);
                $this->set(compact('errorMessages'));
            }

        }
        $filters = $filter->findAll();
        $this->set(compact('user', 'filters'));
    }
}