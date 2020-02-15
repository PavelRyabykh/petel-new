<?php


namespace vendor\core\base;


use vendor\core\Post;

class Controller
{
    public $route = [];
    public $layout = null;
    public $view;
    //Пользовательские данные в вид
    public $data = [];
    public $post;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = $route['action'];
        $this->post = new Post();
    }

    public function getView()
    {
        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj->render($this->data);
    }

    public function set(array $data)
    {
        $this->data = $data;
    }
}