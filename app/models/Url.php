<?php


namespace app\models;


use vendor\core\Auth;
use vendor\core\base\Model;

class Url extends Model
{
    public $table;
    public $properties = [
        'id' => null,
        'url' => null,
        'color' => 'blue',
    ];

    public function __construct()
    {
        parent::__construct();
        $this->table = Auth::getUser();
    }

    public function add()
    {
        $url = $this->findONeWhereAnd(['url', $this->properties['url']], ['color', $this->properties['color']]);
        if ($url) {
            $this->delete($url['id']);
        }

        if (isset($this->properties['url'])) {
            $this->query("INSERT INTO " . $this->table . " (url, color) VALUES (?,?)", [$this->properties['url'], $this->properties['color']]);
            return true;
        } else {
            throw new \Exception("Попытка записать в БД недозаполненную модель Url");
        }
    }

    public function deleteAll()
    {
        $this->deleteTable();
        $this->createTable();
    }

    public function deleteByColor($color)
    {
        return $this->query("DELETE FROM " . $this->table . " WHERE color=?", [$color]);
    }

    public function createTable()
    {
        $sql = "CREATE TABLE " . $this->table . " (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                url TEXT NOT NULL,
                color VARCHAR(10) NOT NULL default('blue')
)";
        $this->query($sql, []);
    }


}