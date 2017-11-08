<?php

	class OrderSynchronizationCallback{

		protected $bizType = "";			//string 20		服務類型
		protected $merchantOrderNo = "";	//string 36		商戶訂單編號
		protected $code = "";				//string 20		提交狀態碼
		protected $message = "";			//string 50		返回訊息
		protected $hmac = "";				//string 32		簽名數據

		// construct
	   	function __construct($str) {
			$arr = json_decode($str);
			if(is_array($arr)){
				foreach ($arr as $key => $value) {
					switch ($key) {
						case 'bizType':
							$this->bizType = $value ;
							break;
						case 'merchantOrderNo':
							$this->merchantOrderNo = $value ;
							break;
						case 'Code':
							$this->code = $value ;
							break;
						case 'message':
							$this->message = $value ;
							break;
						case 'hmac':
							$this->hmac = $value ;
							break;
						default:
							
							break;
					}
				}
			}
		}

		protected function getArray(){
			$array = array(
	   			'bizType' 		=> $this->bizType,
	   			'merchantOrderNo' => $this->merchantOrderNo,
	   			'Code' 			=> $this->Code,
	   			'message' 		=> $this->message,
	   			'hmac' 			=> $this->hmac
	   		);
	   		return $array;
		}

	   	public function getBizType(){
	   		return $this->bizType;
	   	}
	   	public function getMerchantOrderNo(){
	   		return $this->merchantOrderNo;
	   	}
	   	public function getCode(){
	   		return $this->code;
	   	}
	   	public function getMessage(){
	   		return $this->message;
	   	}
	   	public function getHmac(){
	   		return $this->hmac;
	   	}
	}

?>