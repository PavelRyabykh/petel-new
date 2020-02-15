<?php

use vendor\core\Router;
//Examples
//Router::add('^page/(?<action>[a-z-]+)/(?<alias>[a-z-]+)$', ['controller' => 'Page']);
//Router::add('^page/(?<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    Router::add('^$', ['controller' => 'Main', 'action' => 'AddUrl']);
    Router::add('^login$', ['controller' => 'Login', 'action' => 'Check']);
    Router::add('^signup$', ['controller' => 'Signup', 'action' => 'addUser']);
    Router::add('^delurl$', ['controller' => 'Delurl', 'action' => 'index']);
    Router::add('^delall$', ['controller' => 'Delall', 'action' => 'index']);
    Router::add('^delbycolor$', ['controller' => 'Delbycolor', 'action' => 'index']);
    Router::add('^up$', ['controller' => 'Up', 'action' => 'index']);
} else {
    Router::add('^$', ['controller' => 'Main', 'action' => 'Index']);
    Router::add('^login$', ['controller' => 'Login', 'action' => 'index']);
    Router::add('^signup$', ['controller' => 'Signup', 'action' => 'index']);
    Router::add('^logout$', ['controller' => 'Logout', 'action' => 'index']);
    Router::add('^admin$', ['controller' => 'Admin', 'action' => 'index']);
}
