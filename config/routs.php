<?php

use vendor\core\Router;
//Examples
//Router::add('^page/(?<action>[a-z-]+)/(?<alias>[a-z-]+)$', ['controller' => 'Page']);
//Router::add('^page/(?<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    Router::add('^$', ['controller' => 'Main', 'action' => 'AddUrl']);
    Router::add('^login$', ['controller' => 'Login', 'action' => 'Check']);
    Router::add('^signup$', ['controller' => 'admin\\Signup', 'action' => 'addUser']);
    Router::add('^delurl$', ['controller' => 'Delurl', 'action' => 'index']);
    Router::add('^delall$', ['controller' => 'Delall', 'action' => 'index']);
    Router::add('^delbyfilter$', ['controller' => 'Delbyfilter', 'action' => 'index']);
    Router::add('^up$', ['controller' => 'Up', 'action' => 'index']);
    Router::add('^deluser', ['controller' => 'admin\\Deluser', 'action' => 'index']);
    Router::add('^addfilter', ['controller' => 'admin\\AddFilter', 'action' => 'index']);
    Router::add('^delfilter', ['controller' => 'admin\\Delfilter', 'action' => 'index']);
} else {
    Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
    Router::add('^login$', ['controller' => 'Login', 'action' => 'index']);
    Router::add('^signup$', ['controller' => 'admin\\Signup', 'action' => 'index']);
    Router::add('^logout$', ['controller' => 'Logout', 'action' => 'index']);
    Router::add('^admin$', ['controller' => 'admin\\Admin', 'action' => 'index']);
    Router::add('^admin/users/(?<user>[a-z0-9-]+)$', ['controller' => 'admin\\Filters', 'action' => 'index']);
}
