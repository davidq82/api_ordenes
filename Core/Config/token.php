<?php

function generateToken($userId, $email) {
    $secretKey = 'tu_clave_secreta';
    $expiration = time() + 3600;  // Token válido por 1 hora

    $token = base64_encode($userId . '|' . $email . '|' . $expiration . '|' . md5($userId . $secretKey . $expiration));

    return $token;
}

function validateToken($token) {
    $secretKey = 'tu_clave_secreta';
    
    $decoded = base64_decode($token);
    list($userId, $email, $expiration, $hash) = explode('|', $decoded);

    if ($expiration < time()) {
        return false;  // El token ha expirado
    }

    if (md5($userId . $secretKey . $expiration) != $hash) {
        return false;  // El token no es válido o ha sido alterado
    }

    return true;  // El token es válido
}

?>