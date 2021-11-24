<?php

$key = $argv[2];
$message = $argv[3];


function encrypt($plaintext, $password) {
    $method = "AES-256-CBC";
    $key = hash('sha256', $password, true);
    $iv = random_bytes(16);
    $ciphertext =openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);

    return  base64_encode($iv . $ciphertext);
}

function decrypt($ivHashCiphertext, $password) {
    $ivHashCiphertext = base64_decode($ivHashCiphertext);
    $method = "AES-256-CBC";
    $iv = substr($ivHashCiphertext, 0, 16);
    $ciphertext = substr($ivHashCiphertext, 16);
    $key = hash('sha256', $password, true);

    return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
}

if($argv[1]=="e"){
    printf("Crypt => $message\n");
    var_dump(encrypt($message,$key));

}


if($argv[1]=="d"){
    printf("DeCrypt => $message\n");
    var_dump(decrypt($message,$key));
}


?>

