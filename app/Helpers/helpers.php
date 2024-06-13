<?php

if (!function_exists('truncate')) {
    /**
     * Truncate the given string to the specified length and add ellipsis if necessary.
     *
     * @param string $value
     * @param int $limit
     * @return string
     */
    function truncate($value, $limit = 50)
    {
        if (strlen($value) <= $limit) {
            return $value;
        }

        return substr($value, 0, $limit) . '...';
    }
}
