<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('link_active'))
{
    function link_active($pageActive, $page='')
    {
        return $pageActive == $page ? 'class="active"' : '';
    }
}