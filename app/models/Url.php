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
        'filter' => null,
    ];

    public function __construct()
    {
        parent::__construct();
        $this->table = Auth::getUser();
    }

    public function add()
    {
        $url = $this->findONeWhereAnd(['url', $this->properties['url']], ['filter', $this->properties['filter']]);
        if ($url) {
            $this->delete($url['id']);
        }

        if (isset($this->properties['url'])) {
            $this->query("INSERT INTO " . $this->table . " (url, filter) VALUES (?,?)", [$this->properties['url'], $this->properties['filter']]);
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
                filter VARCHAR(10) NOT NULL
)";
        $this->query($sql, []);
    }


}