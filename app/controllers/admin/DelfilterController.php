<?php


namespace app\controllers\admin;


use app\models\Filter;
use vendor\core\Auth;

class DelfilterController extends MainAdminController
{
    public function indexAction()
    {
        Auth::faceControlForAdmin();
        $this->layout = false;
        $filter = new Filter();
        $filter->table = $this->post->workspace . '_filters';
        $filter->delete($this->post->id);
    }
}