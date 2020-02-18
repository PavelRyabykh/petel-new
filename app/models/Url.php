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
        'old_id' => 0
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
            $this->query("INSERT INTO " . $this->table . " (url, filter, old_id) VALUES (?,?,?)", [$this->properties['url'], $this->properties['filter'], $this->properties['old_id']]);
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

    public function deleteByFilter($filter)
    {
        return $this->query("DELETE FROM " . $this->table . " WHERE filter=?", [$filter]);
    }

    public function createTable()
    {
        $sql = "CREATE TABLE " . $this->table . " (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                url TEXT NOT NULL,
                filter VARCHAR(10) NOT NULL,
                old_id INT NOT NULL DEFAULT 0
)";
        $this->query($sql, []);
    }


}