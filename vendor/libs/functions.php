<?php

function debug($arr)
{
    print '<pre>' . print_r($arr, true) . '</pre>';
}

function dd($arr)
{
    print '<pre>' . print_r($arr, true) . '</pre>';
    exit();
}

function ahrefer($str)
{
    $pattern = '/\b(?:https?:\/\/|(?:https?:\/\/)?www\.)[^\s]+/i';
    preg_match_all($pattern, $str, $matches);
    array_walk($matches[0], function (&$value) {
        $value = trim($value, '.,:!?#/;');
    });
    $matches[0] = array_unique($matches[0]);
    foreach ($matches[0] as $value) {

        $str = preg_replace('#(?<!://)' . preg_quote($value) . '#i', '<a target="_balnk" href="' . $value . '">' . $value . '</a>', $str);
    }
    //print $str; exit();
    $str = str_replace('href="www.', 'href="http://www.', $str);
    return $str;
}

function csrfToken($flag = null)
{
    static $token_exists = false;
    if ($token_exists === false) {
        $token_exists = true;
        $_SESSION['token'] = md5(rand(0, 30) . time() . rand(40, 60));
       // file_put_contents('logi.log', "\n----------\n".'Первый вызов - ' . $_SESSION['token'] . "\n", FILE_APPEND);
    }
    if (!is_null($flag)) {
       // file_put_contents('logi.log', 'Последующий вызов - ' . $_SESSION['token'] . "\n", FILE_APPEND);
        return $_SESSION['token'];
    }
    return '<input type="hidden" name="token" value="' . $_SESSION['token'] . '">';

}