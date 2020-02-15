<?php

function debug($arr)
{
    print '<pre>'. print_r($arr, true) .'</pre>';
}

function dd($arr)
{
    print '<pre>'. print_r($arr, true) .'</pre>';
    exit();
}

function ahrefer($str)
{
    $pattern = '/\b(?:https?:\/\/|(?:https?:\/\/)?www\.)[^\s]+/i';
    preg_match_all($pattern, $str, $matches);
    array_walk($matches[0], function(&$value){$value = trim($value, '.,:!?#/;');});
    $matches[0] = array_unique($matches[0]);
    foreach($matches[0] as $value)
    {
        $str = preg_replace('`(?<!://)'.str_replace(['.', '`', '?'], ['\.', '\`', '\?'], $value).'`i', '<a target="_balnk" href="'.$value.'">'.$value.'</a>', $str);
    }
    $str = str_replace('href="www.', 'href="http://www.', $str);
    return $str;
}