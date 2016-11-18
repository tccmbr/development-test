<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('link_active'))
{
    function link_active($page='')
    {
        return current_url() == $page ? 'class="active"' : '';
    }
}