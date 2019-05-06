<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\AppException;
use App\Item;

class CardGameController extends Controller
{
    public function buy(Request $request) {

    	// $request->validate([
    	// 	'service_id' => 'required',
    	// 	'item_id' => 'required',
    	// 	'quantity' => 'required|numeric',
    	// 	'amount' => 'required|numeric',
    	// ]);
    	

    	set_time_limit(0);
    	$data = $this->postUrl();
    	dd($data);
    }

    //Hàm gọi sáng Alego
	public function postUrl() {

		$url = "http://dev.alego.vn:8888/agent_api/";
	    //Định nghĩa Header khi gọi
	    $headerArray = array(
	        'Content-Type: application/json; charset=UTF-8',
	    );
	    dd($this->dataCard());
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $this->dataCard());
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 60);

	    $result = curl_exec($ch);
	    $result = json_decode($result, true);
	    return $result;
	}

    public function encryptData($input, $key_seed = "1234567890123") {

	    $encrypted_data = base64_encode($input);

	    return $encrypted_data;
    }

	public function dataCard() {
	//ID tài khoản của đại lý
	    $AccID = "571a01a0e4b0b96b6f950ad5";
	//Mã dịch vụ, sản phẩm
	    $ProductCode = 300;
	    $CardNumber = 1;
	//Mã tham chiếu đại lý gửi sang (mã này là duy nhất trong mỗi lần gửi sang)
	    $RefNumber = "DL" . time() . rand(1000, 9999);


	//Mảng dữ liệu thông tin đơn hàng
	    $data = array(
	        //Ma sản phẩm
	        'ProductCode' => $ProductCode,
	        //Mã tham chiếu đại lý gửi sang
	        'RefNumber' => $RefNumber,
	        //Địa chỉ IP của đại lý
	        'CustIP' => "127.0.0.1",
	        //Mệnh giá thẻ mua
	        'CardPrice' => 10000,
	        //Số lượng thẻ mua
	        'CardQuantity' => $CardNumber,
	    );
	    // var_dump($data);
	//Key tạo checksum cap cho dai ly
	    $connectKey = 'adrMjEJArHysrhwM';
	//Tạo string json
	    $data = json_encode($data);
	//Mã hóa String data
	    $EncData = $this->encryptData($data);
	//Hàm thực hiện mua dữ liệu
	    $Func = "buyPrepaidCards";
	    $ver = '1.0';
	    $agentId = 1;

	//Tạo mã checksum, chữ ký
	    $CheckSum = md5($Func . $ver . $agentId . $AccID . $EncData . $connectKey);

	//Khởi tạo mảng dữ liệu gọi sang Alego
	    $inputs = array(
	        'Fnc' => $Func,
	        'Ver' => $ver,
	        'AgentID' => $agentId,
	        'AccID' => $AccID,
	        'EncData' => $EncData,
	        'Checksum' => $CheckSum,
	    );

	//Thực hiện tạo String json mảng
	    // echo $inputs = json_encode($inputs);
	    return $inputs;
	}
}
