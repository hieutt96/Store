<?php

return 
	
	[
		\App\Exceptions\AppException::ERR_NONE => 'Thành công',
		\App\Exceptions\AppException::ERR_ACCOUNT_NOT_FOUND => 'Không tìm thấy tài khoản',
		\App\Exceptions\AppException::ERR_SYSTEM => 'Lỗi hệ thống',
		\App\Exceptions\AppException::ACCOUNT_NOT_ACTIVE => 'Tài khoản chưa được active',
		\App\Exceptions\AppException::ERR_AUTHORIZATION => 'Lỗi xác thực request',
		\App\Exceptions\AppException::REQUEST_EXPIRED => 'Request hết hạn',
		\App\Exceptions\AppException::ERR_NO_SERVICE => 'Hệ thống không có dịch vụ bạn vừa chọn',
		\App\Exceptions\AppException::ERR_SERVICE_NOT_FOUND => 'Không có dịch vụ bạn vừa chọn',
		\App\Exceptions\AppException::ERR_SERVICE_NOT_AMOUNT => 'Dịch vụ không có số tiền vừa chọn',
		\App\Exceptions\AppException::ERR_JWT_TIMEOUT => 'Jwt hết hạn',
		\App\Exceptions\AppException::ERR_BALANCE_ENOUGHT => 'Số dư tài khoản không đủ',
		\App\Exceptions\AppException::ERR_IP_NOT_ALLOWED => 'Địa chỉ IP máy chủ không cho phép',
		\App\Exceptions\AppException::ERR_BALANCE_ACCOUNT_SYSTEM_ENOUGHT => 'Số dư tài khoản hệ thống không đủ để thực hiện giao dịch',
		
	];
