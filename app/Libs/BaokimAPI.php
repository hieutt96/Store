<?php 

namespace App\Libs;

use Firebase\JWT\JWT;
use App\Libs\RequestAPI;
use App\Exceptions\AppException;

class BaokimAPI {

    const TOKEN_EXPIRE = 90; //token expire time in seconds
    const ENCODE_ALG = 'HS256';
    const API_TIMEOUT = 30.0; //API timeout in seconds
    private static $_jwt = null;

    public static function refreshToken(){

        $tokenId    = base64_encode(123456); //TODO: cần fix
        $issuedAt   = time();
        $notBefore  = $issuedAt;
        $expire     = $notBefore + self::TOKEN_EXPIRE;
        /*
         * Create the token as an array
         */
        $data = [
            'iat'  => $issuedAt,         // Issued at: time when the token was generated
            'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
            'iss'  => env('API_KEY'),     // Issuer
            'nbf'  => $notBefore,        // Not before
            'exp'  => $expire,           // Expire
            'data' => [                  // Data related to the signer user
                //'userId'   => 1, // userid from the users table
                //'userName' => 'dangld', // User name
            ]
        ];

        self::$_jwt = JWT::encode(
            $data,      //Data to be encoded in the JWT
            env('SECRET_KEY'), // The signing key
            self::ENCODE_ALG     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
        );

        return self::$_jwt;
    }

    public static function getJWT() {
        if(!self::$_jwt){
        	self::refreshToken();
        }
        try {
            JWT::decode(self::$_jwt, env('SECRET_KEY'), [self::ENCODE_ALG]);
        }catch(Exception $e){
            self::refreshToken();
        }
        return self::$_jwt;
    }

    public static function getListService() {

    	$jwt = self::getJWT();
    	// dd($jwt);
    	$response = RequestAPI::requestBaokim('GET', 'https://api.baokim.vn/payment/api/v4/vat/list', [
    		'query' => [
    			'jwt' => $jwt,
    		],
    	]);
    	if($response->code != AppException::ERR_NONE) {

    		throw new AppException(AppException::ERR_SYSTEM);
    	}
    	return $response->data;
    }

    public static function buyService($mrcOrderId, $serviceItemId, $amount, $phone = null) {
 
        $data = [
            'mrc_order_id' => $mrcOrderId,
            'service_item_id' => $serviceItemId,
            'amount' => $amount,

        ];
        if($phone) {
            $data['phone'] = $phone;
        }
        
        // $response = RequestAPI::requestBaokim('POST', 'https://api.baokim.vn/payment/api/v4/vat/purchase', [
        //     'query' => [
        //         'jwt' => self::generateJwt($data),
        //     ],
        //     'form_params' => $data,
        // ]);
        // dd($response);
        $response = [

            "code" => 0,
            "message" => [],
            'count' => 0,
            'data' => [

                'success' => 1,
                'mrc_order_id' => '1559188453_mywallet',
                "service_item_id" => '1',
                'service' => 'CARD_MOBILE',
                'param' => 'VIETTEL',
                'amount' => 10000,
                'pin' => '618469865791143',
                "seri" => "10004526431431",
                "transaction_id" => "100174633",
                "created_at" => "2019-05-30 10:54:14",
            ]
        ];
        $response = (object) $response;

        if($response->code != AppException::ERR_NONE) {

            throw new AppException(AppException::ERR_SYSTEM);
        }

        return $response;
    }

    public static function generateJwt($data = []) {

        $issuedAt   = time();
        $expire     = $issuedAt + 60;
        $token = array(
            'iat'  => $issuedAt,
            "iss" => env('API_KEY'),
            "aud" => 'https://api.baokim.vn/payment/vat',
            'exp'  => $expire,
            'form_params' => $data,
        );

        return JWT::encode($token, env('SECRET_KEY'), 'HS256');
    }
}