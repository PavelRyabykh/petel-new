<?php


namespace app\controllers\Admin;


use app\models\Filter;
use app\models\Url;
use vendor\core\Auth;

class DelfilterController extends MainAdminController
{
    public function indexAction()
    {
        Auth::faceControlForAdmin();
        $this->layout = false;
        $filter = new Filter();
        $url = new Url();
        $filter->table = $this->post->workspace . '_filters';
        $url->table = $this->post->workspace;
        $filterName = ($filter->findOne($this->post->id))['filter'];
        $url->deleteByFilter($filterName);
        $filter->delete($this->post->id);
    }
}