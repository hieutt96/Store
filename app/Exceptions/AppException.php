<?php 

namespace App\Exceptions;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Exception;
use Log;
use Illuminate\Http\Request;

class AppException extends Exception{

	const ERR_NONE = 0;

	const ERR_ACCOUNT_NOT_FOUND = 1;
	
	const ERR_SYSTEM = 3;
	const ERR_NOT_USER = 4;
	const ERR_VALIDATION = 5;
	const ERR_INVALID_TOKEN = 6;
	const EMAIL_EXIST = 7;
	const ACCOUNT_NO_EXIST = 8;
	const ACCOUNT_NOT_ACTIVE = 9;
	const ERR_AUTHORIZATION = 10;
	const REQUEST_EXPIRED = 11;
	const ERR_NO_SERVICE = 12;
	const ERR_SERVICE_NOT_FOUND = 13;
	const ERR_SERVICE_NOT_AMOUNT = 14;
	const ERR_JWT_TIMEOUT = 15;
	const ERR_BALANCE_ENOUGHT = 18;
	const ERR_IP_NOT_ALLOWED = 17;
	const ERR_BALANCE_ACCOUNT_SYSTEM_ENOUGHT = 16;

	public $message = [];
	public $code;

	public function __construct($code = Response::HTTP_INTERNAL_SERVER_ERROR, $message = [], $data = []) {

		if (!$message) {
			$message = trans('exception.'.$code, $data);
		}

		if (!$code) {
			$code = Response::HTTP_NOT_FOUND;
		}

		$this->code = $code;
		$this->message = $message ?: 'Server Exception';

		parent::__construct($message, $code);
	}

	public function render() {

		$json = [
			'code' => $this->code,
			'message' => [$this->message],
			'data' => null,
		];

		return new JsonResponse($json);
	}

	public function report() {
		Log::emergency($this->message);
	}
}