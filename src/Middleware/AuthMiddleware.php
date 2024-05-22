<?php

namespace App\Middleware;

use App\Helpers;

class AuthMiddleware {
    public static function handle() {
        session_start();
        
        if (!isset($_SESSION['id_account'])) {
            Helpers::redirect('/forbidden');
        }
    }
}
