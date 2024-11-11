<?php

class ApiKeyManager {
    public static function validateApiKey($apiKey) {
        if ($apiKey === '123') {
            return true;
        }
    }
}