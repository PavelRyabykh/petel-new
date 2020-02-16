<?php


namespace app\models;


use vendor\core\Auth;
use vendor\core\base\Model;

class Filter extends Model
{
    public $table;
    public $properties = [
        'id' => null,
        'filter' => null,
        'color' => null,
        'short_name' => null
    ];

    public function __construct()
    {
        parent::__construct();
        $this->table = Auth::getUser() . '_filters';
    }

    public function add()
    {
        $filter = $this->findOne($this->properties['filter'], 'filter');
        if ($filter) {
            $this->errors[] = "Фильтр с таким именем уже существует";
            return false;
        }

        if (isset($this->properties['filter']) && isset($this->properties['color']) && isset($this->properties['short_name'])) {
            $this->query("INSERT INTO " . $this->table . " (filter, color, short_name) VALUES (?,?,?)", [$this->properties['filter'], $this->properties['color'], $this->properties['short_name']]);
            return true;
        } else {
            throw new \Exception("Попытка записать в БД недозаполненную модель User");
        }
    }

    public function createTable()
    {
        $sql = "CREATE TABLE " . $this->table . " (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                filter TEXT NOT NULL,
                color VARCHAR(10) NOT NULL,
                short_name VARCHAR(2) NOT NULL
)";
        $this->query($sql, []);
    }
}