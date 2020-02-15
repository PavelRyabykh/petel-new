<?php


namespace app\models;


use vendor\core\Auth;
use vendor\core\base\Model;

class User extends Model
{
    public $table = 'users';
    public $properties = [
        'id' => null,
        'login' => null,
        'password' => null,
        'is_admin' => null,
    ];


    public function add()
    {
        $login = $this->findOne($this->properties['login'], 'login');
        if ($login) {
            $this->errors[] = "Пользователь с таким именем уже существует";
            return false;
        }

        if (isset($this->properties['login']) && isset($this->properties['password'])) {
            $this->query("INSERT INTO " . $this->table . " (login, password) VALUES (?,?)", [$this->properties['login'], $this->properties['password']]);
            return true;
        } else {
            throw new \Exception("Попытка записать в БД недозаполненную модель User");
        }
    }

    public function checkAuth()
    {
        if (isset($this->properties['login']) && isset($this->properties['password'])) {
            $row = $this->findOne($this->properties['login'], 'login');
            if ($row) {
                if (password_verify($this->properties['password'], $row['password'])) {
                    if ($row['is_admin'] === '1') {
                        return 1;
                    } elseif ($row['is_admin'] === '0') {
                        return -1;
                    }
                } else {
                    $this->errors[0] = "Неверный логин или пароль";
                    return false;
                }
            } else {
                $this->errors[0] = "Неверный логин или пароль";
                return false;
            }
        } else {
            throw new \Exception("Попытка проверить авторизацию в недозаполненной модели");
        }
    }

}