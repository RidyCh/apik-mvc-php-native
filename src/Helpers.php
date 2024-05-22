<?php

namespace App;

class Helpers 
{
    /**
     * Redirect to a specific URL
     *
     * @param string $url
     * @param int $statusCode
     */
    public static function redirect($url, $statusCode = 302) {
        header('Location: ' . $url, true, $statusCode);
        exit();
    }

    /**
     * Redirect back to the previous page
     */
    public static function back() {
        $previous = $_SERVER['HTTP_REFERER'] ?? '/';
        self::redirect($previous);
    }
}
