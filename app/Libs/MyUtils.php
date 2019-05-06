<?php

class MyUtils {

    public static function dec_enc($action, $string, $secret_app, $secret_id) {

        $out = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_app);
        $id = substr(hash('sha256', $secret_id), 0, 16);
        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $id);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $id);
        }
     
        return $output;
    }
}