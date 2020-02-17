<?php


namespace app\controllers\Admin;


use app\models\Filter;
use vendor\core\Auth;
use vendor\core\Validator;

class AddFilterController extends MainAdminController
{
    public function indexAction()
    {
        Auth::faceControlForAdmin();
        $this->layout = false;
        $filter = new Filter();
        $filter->table = $this->post->user . '_filters';
        if(! ($errors = Validator::filter($this->post->filter, $this->post->color, $this->post->short_name))) {
            $filter->filter = htmlspecialchars($this->post->filter);
            $filter->color = htmlspecialchars($this->post->color);
            $filter->short_name = htmlspecialchars($this->post->short_name);
        } else {
            $_SESSION['status'] = false;
            $_SESSION['errors'] = $errors;
            header('Location: '.$_SERVER['HTTP_REFERER']);
            exit();
        }

        if ($filter->add()) {
            $_SESSION['status'] = true;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['status'] = false;
            $_SESSION['errors'] = $filter->errors;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}