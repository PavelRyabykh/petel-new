<?php


namespace vendor\core;


class Auth
{
    private static $user;
    private static $status;
    private static $instance;
    private function __construct()
    {
        if (isset($_SESSION['user'])) {
            self::$user = $_SESSION['user'];
            self::$status = $_SESSION['is_admin'];
        }
    }

    public static function faceControl($where = 'NotInLogin')
    {
        if (self::$status === 1) {
            header('Location: /admin');
            exit();
        } elseif (self::$user === null && $where !== 'login') {
            header('Location: /login');
            exit();
        } elseif (self::$user !== null && $where === 'login') {
            return true;
        }
        return false;
    }

    public static function faceControlForAdmin()
    {
        if (!self::$status == 1) {
            header('Location: /');
        }
    }

    public static function getUser()
    {
        if (! (self::$user === null)) {
            return self::$user;
        }  else {
            return false;
        }

    }

    public static function getStatus()
    {
        return self::$status;
    }

    public static function setStatus($status)
    {
        $_SESSION['is_admin'] = $status;
        self::$status = $status;
    }

    public static function setUser($user)
    {
        $_SESSION['user'] = $user;
        self::$user = $user;
    }

    public static function unsetUser()
    {
        self::$user = null;
        self::$status = null;
        unset($_SESSION['user']);
        unset($_SESSION['is_admin']);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}