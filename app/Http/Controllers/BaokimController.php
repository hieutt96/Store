<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\BaokimAPI;
use App\Service;
use App\Item;
use App\Exceptions\AppException;
use App\Transaction;
use App\Libs\RequestAPI;
use App\Libs\MyUtils;
use Log;

class BaokimController extends Controller
{
    
    public function listService(Request $request) {

    	$services = BaokimAPI::getListService();
    	return $this->_responseJson($services);
    }

    public function buyService(Request $request) {

    	$request->validate([
    		'service_id' => 'required',
    		'item_id' => 'required',
    		'quantity' => 'required',
    		'amount' => 'required',
    		'password' => 'required',
    	]);
    	
		if($request->has('email')) {
			$email = $request->email;
		}else {
			$accessToken = $request->access_token;
			$rs = RequestAPI::request('GET', '/api/user/detail', [
				'headers' => ['Authorization' => 'Bearer '.$accessToken]
			]);
			$email = $rs->data->email;
		}
		MyUtils::checkPassword($email, $request->password);

		$userId = MyUtils::getUserId($email);

		$balance = MyUtils::getBalance($userId);

		if($balance < $request->amount * $request->quantity) {

			throw new AppException(AppException::ERR_BALANCE_ENOUGHT);
			
		}

    	$service = Service::find($request->service_id);
    	$item = Item::find($request->item_id);
    	$services = (array) BaokimAPI::getListService();
    	if(count($services)) {

    		foreach($services as $key => $value) {

    			if($value->info->code == $service->name) {
    				$items = $value->items;
    				$name = $service->name;
    				break;
    			}
    		}
    	}else {
    		throw new AppException(AppException::ERR_SERVICE_NOT_FOUND);
    		
    	}
    	if(count($items) && isset($items)) {

    		foreach($items as $key => $value) {

    			if($value->name == $item->code) {
    				$serviceItem = $value;
    				break;
    			}
    		}
    	}else {
    		throw new AppException(AppException::ERR_NO_SERVICE);
    		
    	}
    	if(isset($serviceItem)) {
    		// dd($serviceItem);
    		$listAmount = $serviceItem->list_amount;
    		$name .= '.'.$serviceItem->name;

    		$discount = $serviceItem->discount + $item->discount;

    		foreach(explode(',', $listAmount) as $key => $value) {
    			if($value == $request->amount/1000) {
    				$amount = $value;
    				break;
    			}
    		}

    		if(isset($amount)) {
    			$mrcOrderId = time().'_mywallet';
	    		if($request->phone) {
	    			$phone = $request->phone;
	    		}else {
	    			$phone = null;
	    		}
	    		$amountDiscount = $amount*1000 + $discount*10*$amount;
	    		dd($amountDiscount);
	    		$response = BaokimAPI::buyService($mrcOrderId, $serviceItem->id, $amount, $phone);

	    		dd($response);
	    		$this->minusUser($userId, $amountDiscount);

	    		$trs = new Transaction;
	    		$trs->service_items_id = $serviceItem->id;
	    		$trs->amount = $amount;
	    		$trs->quantity = $request->quantity;
	    		$trs->param = $name;
	    		$trs->code = $response->data->pin;
	    		$trs->serial = $response->data->seri;
	    		$trs->note = $name;
	    		$trs->save();

	    		$log = new Log;
	    		$log->transaction_id = $transaction->id;
	    		$log->resCode = $response->code;
	    		$log->dataRes = $response->data;
	    		$log->save();

    		}else {
    			throw new AppException(AppException::ERR_SERVICE_NOT_AMOUNT);
    		}
    		
    	}else {

    		throw new AppException(AppException::ERR_SERVICE_NOT_FOUND);
    		
    	}
    }

    public function minusUser($userId, $amount) { 

    	$rs = RequestAPI::requestLedger('POST', '/api/store/minus', [
    		'form_params' => [
    			'user_id' => $userId,
    			'amount' => $amount,
    		]
    	]);
    	if($rs->code != AppException::ERR_NONE) {

    		throw new AppException(AppException::SYSTEM);
    		
    	}
    }
}
