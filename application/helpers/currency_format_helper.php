<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('currency_format')) {
    function currency_format($value = 0)
    {
        setlocale(LC_MONETARY, array('pt_BR', 'pt_BR.utf8'));
        $value = is_numeric($value) ? $value : 0;
        return money_format('%n', $value);
    }
}