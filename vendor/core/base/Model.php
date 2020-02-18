<?php


namespace vendor\core\base;


use vendor\core\Db;

abstract class Model
{
    protected $pdo;
    protected $table;
    protected $pk = 'id';
    public $properties = [];
    public $errors = [];

    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->properties)) {
            $this->properties[$name] = $value;
        } else {
            throw new \Exception("Попытка записать в модель свойство {$name}, которое не поддерживается таблицей");
        }
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        } else {
            throw new \Exception("Попытка обратиться к несуществующием свойству {$name} модели");
        }
    }

    public function __construct()
    {
        $this->pdo = Db::getInstance();
    }

    public function query($sql, $params)
    {
        return $this->pdo->execute($sql, $params);
    }

    public function findAll()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        return $this->pdo->query($sql);
    }

    public function findOne($id, $field = null)
    {
        $field = $field ?? $this->pk;
        $sql = "SELECT * FROM {$this->table} WHERE {$field} = ?";
        $result = $this->pdo->query($sql, [$id]);
        if($result) {
            return $result[0];
        } else {
            return [];
        }
    }

    public function delete($id)
    {
        if ($this->findOne($id)) {
            return $this->query("DELETE FROM " . $this->table . " WHERE id=?", [$id]);
        } elseif ($this->findOne($id, 'old_id')) {
            return $this->query("DELETE FROM " . $this->table . " WHERE old_id=?", [$id]);
        }
    }

    public function findOneWhereAnd($params1, $params2)
    {
        $sql = "SELECT * FROM {$this->table} WHERE $params1[0] = ? AND $params2[0] = ?";
        $result = $this->pdo->query($sql, [$params1[1], $params2[1]]);
        if($result) {
            return $result[0];
        } else {
            return [];
        }
    }

    public function findBySQL($sql, $params = [])
    {
        return $this->pdo->query($sql, $params);
    }

    public function findLike($str, $field)
    {
        $str = strtr($str, ['_' => '\_', '%' => '\%']);
        $sql = "SELECT * FROM $this->table WHERE $field LIKE ?";
        return $this->pdo->query($sql, ['%'.$str.'%']);
    }

    public function deleteTable()
    {
        $this->pdo->execute("DROP TABLE $this->table");
    }
}