<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\ServiceItem;
use App\Exceptions\AppException;

class ServiceController extends Controller
{
    public function list(Request $request) {

    	$services = Service::where('stat', 1)->get();
    	$data = [];
    	if(count($services)) {
    		foreach($services as $service) {

    			$data [] = [
    				'id' => $service->id,
    				'name' => $service->name,
    				'description' => $service->description,
    			];
    		}
    		return $this->_responseJson(
	 			$data, count($data),
	    	);
    	}
    	throw new AppException(AppException::ERR_NO_SERVICE);
    	
    }

    public function listItem(Request $request) {

    	$request->validate([
    		'services_id' => 'required|numeric',
    	]);

    	$serviceItems = ServiceItem::where('services_id', $request->services_id)->where('stat', 1)->get();
    	$data = [];
    	if(count($serviceItems)) {
    		foreach($serviceItems as $item) {
    			$data [] = [
    				'services_id' => $item->services_id,
    				'code' => $item->code,
    				'name' => $item->name,
    				'discount' => $item->discount,
    				'amount' => $item->amount,
    			];
    		}
    	}
    }
}
