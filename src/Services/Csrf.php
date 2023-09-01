<?php

namespace App\Services;

class Csrf
{
    public static function generate(): string
    {
        // TODO: Check that the size of array is not too big (max 30)

        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf'][] = $token;
        return $token;
    }

    public static function check(string $token): bool
    {
        if (!isset($_SESSION['csrf'])) return false;

        if (!in_array($token, $_SESSION['csrf'])) return false;

        array_splice($_SESSION['csrf'], array_search($token, $_SESSION['csrf']), 1);
        return true;
    }
}