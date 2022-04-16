<?php

if (!function_exists('phone_clear')) {
    function phone_clear($expression): string
    {
        return str_replace(['(', ')', ' ', '-'], '', $expression);
    }
}
if (!function_exists('searchColspan')) {
    function searchColspan($row): array
    {
        $items = [];
        $keys = array_keys($row);
        $values = array_values($row);
        $colspan = 1;
        $current_key = '';
        foreach ($keys as $index => $key) {
            $colspan++;
            if (!$current_key) {
                $current_key = $key;
            }
            if ($values[$index]) {
                $current_key = $key;
                $colspan = 1;
            }
            $items[$current_key] = $colspan;
        }
        return $items;
    }
}
