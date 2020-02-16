<?php


namespace vendor\core;


class Post
{
    private $data = [];
    private $legacyData = ['login', 'password', 'url', 'notformat', 'id', 'delall', 'color', 'up', 'short_name', 'filter', 'user', 'workspace'];
    public function __construct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->data = $_POST;

            foreach ($this->data as $k => $v) {
                if(!in_array($k, $this->legacyData)) {
                    throw new \Exception("Переданы нелегальные данные");
                }
            }
        }
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return trim($this->data[$name]);
        } else {
            return null;
        }
    }
}