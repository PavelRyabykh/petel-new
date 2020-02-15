<?php


namespace vendor\core;


class Validator
{
    public static function integer($int)
    {
        if (filter_var($int, FILTER_VALIDATE_INT)) {
            return true;
        } else {
            return false;
        }
    }

    public static function login($login, $password)
    {
        $errors = [];

        if (!self::validLogin($login)) {
            $errors[] = 'Неверный логин или пароль';
            return $errors;
        }

        if (!self::validPassword($password)) {
            $errors[] = 'Неверный логин или пароль';
            return $errors;
        }
        return $errors;
    }

    public static function signup($login, $password)
    {
        $errors = [];

        if (!self::validLogin($login)) {
            $errors[] = 'Логин должне состоять из латинских букв или цифр не более 10 символов';
        }

        if (!self::validPassword($password)) {
            $errors[] = 'Пароль должен состоять из латинских букв, цифр или спец символов';
        }
        return $errors;
    }

    public static function url($url)
    {
        $errors = [];

        if (!self::validUrl($url)) {
            $errors[] = 'Поле является обязательным';
        }
        return $errors;
    }

    public static function color($color, $legacyColors)
    {
        if (in_array($color, $legacyColors) || is_null($color)) {
            return true;
        } else {
            return false;
        }
    }

    private static function validLogin($login)
    {
        if (preg_match('#^[a-z0-9]{1,10}$#i', $login)) {
            return true;
        } else {
            return false;
        }
    }

    private static function validPassword($password)
    {
        if (preg_match('#^[a-z0-9!@\#$%^&*()_+=/.,<>\\?\]\[{}-]{1,30}$#i', $password)) {
            return true;
        } else {
            return false;
        }
    }

    private static function validUrl($url)
    {
        if (preg_match('#^.{1,1000}$#i', $url)) {
            return true;
        } else {
            return false;
        }
    }


}