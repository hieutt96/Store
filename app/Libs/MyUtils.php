<?php

namespace App\Libs;

use App\Libs\RequestAPI;
use App\Exceptions\AppException;

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

    public static function checkPassword($email, $password) {

        $rsx = RequestAPI::request('POST', '/api/check-password',[
                'form_params' => [
                    'email' => $email,
                    'password' => $password,
                ]
            ]);
        if($rsx->code != AppException::ERR_NONE) {
            throw new AppException($rsx->code, $rsx->message);
            
        }
    }

    public static function getUserId($email) {

        $rs = RequestAPI::request('GET', '/api/get-user', [
            'query' => [
                'email' => $email,
            ],
        ]);
        if($rs->code != AppException::ERR_NONE) {
            throw new AppException($rs->code, $rs->message);
            
        }
        return $rs->data->user_id;
    }

    public static function getBalance($userId) {

        $rs = RequestAPI::requestLedger('GET', '/api/balance', [
            'query' => [
                'user_id' => $userId,
            ],
        ]);
        if($rs->code != AppException::ERR_NONE) {
            throw new AppException($rs->code, $rs->message);
            
        }
        return $rs->data->balance;
    }
}