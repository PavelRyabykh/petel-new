<?php
use vendor\core\Router;

require_once dirname(__DIR__) . '/config/init.php';
new \vendor\core\App();
Router::dispatch(trim($_SERVER['QUERY_STRING'], '/'));
