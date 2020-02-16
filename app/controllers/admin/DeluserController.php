<?php


namespace app\controllers\admin;


use app\models\Filter;
use app\models\Url;
use app\models\User;
use vendor\core\Auth;

class DeluserController extends MainAdminController
{
    public function indexAction()
    {
        Auth::faceControlForAdmin();
        $this->layout = false;
        $user = new User();
        $url = new Url();
        $filter = new Filter();
        $userName = ($user->findOne($this->post->id))['login'];
        $user->delete($this->post->id);
        $url->table = $userName;
        $url->deleteTable();
        $filter->table = $userName . '_filters';
        $filter->deleteTable();
    }
}