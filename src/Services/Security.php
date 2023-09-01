<?php

namespace App\Services;

class Security {
    public static function isConnected(): bool {
        return isset($_SESSION['user']['id']);
    }

    public static function isAdmin(): bool {
        return $_SESSION['user']['isAdmin'] ?? false;
    }


}