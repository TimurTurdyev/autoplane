<?php

if (!function_exists('phone_clear')) {
    function phone_clear($expression)
    {
        return str_replace(['(', ')', ' ', '-'], '', $expression);
    }
}
