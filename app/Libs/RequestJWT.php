<?php 

namespace App\Libs;

use Firebase\JWT\JWT;
use App\Exceptions\AppException;

class RequestJWT {

	const ENCODE_ALG = 'HS256';


	public static function decodeJWT($jwt) {
		$secret = env('WEB_API_SECRET', 'auQszsTMdamHJK8GUAsg');
		try {

			$data = JWT::decode($jwt, $secret, [self::ENCODE_ALG]);

		}catch(\Exception $e) {

			if(in_array(get_class($e), ['Firebase\JWT\SignatureInvalidException'])) {
				throw new AppException(AppException::ERR_AUTHORIZATION, 'Lỗi giải mã jwt');
			}
			if(in_array(get_class($e), ['Firebase\JWT\ExpiredException'])) {

				throw new AppException(AppException::ERR_JWT_TIMEOUT);
			}
		}
		return $data;
	}
}