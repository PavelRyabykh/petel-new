<?php


namespace vendor\core\base;


class View
{
    public $route = [];
    public $view;
    public $layout;

    public function __construct($route, $layout = '', $view = '')
    {
        if($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?? LAYOUT;
        }
        $this->route = $route;
        $this->view = $view;

    }

    public function render($data)
    {
        extract($data);
        $file_view = APP . "/views/{$this->route['controller']}/{$this->view}.php";
        ob_start();
        if(file_exists($file_view)) {
            require $file_view;
        } else {
            print "<p></p>Вид <b>$file_view</b> не найден.</p>";
        }
        $content = ob_get_clean();
        if(false !== $this->layout) {
            $file_layout = APP .'/views/layouts/'.$this->layout.'.php';
            if(file_exists($file_layout)) {
                require $file_layout;
            } else {
                print "<p></p>Шаблон <b>$file_layout</b> не найден.</p>";
            }
        }
    }
}