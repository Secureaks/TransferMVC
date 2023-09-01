<?php

namespace App\Services;

class Message {
    public static function addMessage(string $message): void {
        $_SESSION['message'][] = $message;
    }

    public static function getMessages(): array {
        $messages = $_SESSION['message'] ?? [];
        unset($_SESSION['message']);
        return $messages;
    }
}