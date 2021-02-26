<?php


if (!function_exists('format_date')) {
    /**
     * Format date according to local module configuration.
     * @param object $date
     * @param string $format
     *
     * @return string
     **/

    function format_date($date, $format = '%A, %B %d, %Y')
    {
        return strftime($format, strtotime($date));
    }

}
