<?php

namespace vendor\core;

class ErrorHandler
{
    public function __construct()
    {
        if (DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        set_error_handler([$this, 'errorHandler']);
        set_exception_handler([$this, 'exceptionHandler']);
    }

    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        $this->logErrors($errstr, $errfile, $errline);
        $this->displayError($errno, $errstr, $errfile, $errline);
    }

    public function exceptionHandler($e)
    {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    public function logErrors($message = '', $file = '', $line = '')
    {
        $error = "[" . date('Y-m-d H:i:s') . "]\nТекст ошибки: {$message}\nФайл: {$file}\nСтрока: {$line}\n==================================\n";
        error_log($error, 3, ROOT . '/tmp/error.log');
    }

    protected function displayError($errno, $errstr, $errfile, $errline, $response = 500)
    {
        http_response_code((int) $response);
        if ($response == 404 && !DEBUG) {
            include APP . '/views/404.html';
        } elseif (DEBUG) {
            require APP . '/views/dev.php';
        } else {
            require APP . '/views/prod.php';
        }
        die;
    }
}