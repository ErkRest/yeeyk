<?php

	class OrderQuery{
		// control value
		private $alog = "md5";
		private $skey = "";

		protected $merchantNo = "";			//string 11		商戶編號
		protected $merchantOrderNo = "";	//string 36		商戶訂單號
		protected $hmac = "";				//string 32		簽名數據

		// construct
		function __construct($array) {
			try{
				foreach ($array as $key => $value) {
					if (is_null($value)) {
	   					throw new Exception("parameter array's value must not null value", 1);
	   				}
					switch ($key) {
						case 'skey':
			    			$this->skey = $value;
			    			break;
						case 'alog':
			    			$this->alog = $value;
			    			break;
						case 'merchantNo':
							$this->merchantNo=$value;
							break;
						case 'merchantOrderNo':
							$this->merchantOrderNo=$value;
							break;
						case 'hmac':
							$this->hmac=$value;
							break;
						default:
							throw new Exception("OrderQuery value error", 1);
							break;
					}
				}
				$str = $this->merchantNo.$this->merchantOrderNo;
	   			$this->hmac = hash_hmac ( 'md5', $str , $this->skey);
			}
			catch(Excption $e){
				echo $e->message();
			}
	   	}

	   	//取得 CURL POST所需 資料字串
	   	public function getPostSteam(){
	   		$data = array( 
	   				"merchantNo"=> $this->merchantNo, 
	   				"merchantOrderNo"=> $this->merchantOrderNo,
	   				"hmac"=> $this->hmac
	   			);
			return http_build_query($data);
	   	}
	}


?>